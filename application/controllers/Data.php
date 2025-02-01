<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function hit_api()
    {
        $username = $this->get_username_from_header();

        $password = $this->create_password();

        $data = [
            'username' => $username,
            'password' => $password
        ];

        $url = 'https://recruitment.fastprint.co.id/tes/api_tes_programmer';

        $response = $this->send_post_request($url, $data);

        $data = $response['data'];

        $kategori = [];
        $status = [];
        $produk = [];
        foreach ($data as $item) {
            $kategori[] = $item['kategori'];
            $status[] = $item['status'];
            $produk[] = $item;
        }

        $kategori = array_unique($kategori);
        $status = array_unique($status);
        foreach ($kategori as $kat) {
            $query = $this->db->get_where('kategori', ['nama_kategori' => $kat]);
            if ($query->num_rows() == 0) {
                $this->db->insert('kategori', ['nama_kategori' => $kat]);
            }
        }

        foreach ($status as $stat) {
            $query = $this->db->get_where('status', ['nama_status' => $stat]);
            if ($query->num_rows() == 0) {
                $this->db->insert('status', ['nama_status' => $stat]);
            }
        }

        foreach ($produk as $prod) {
            $existing_product = $this->db->get_where('produk', ['id_produk' => $prod['id_produk']])->row();

            if (!$existing_product) {
                $kategori_id = $this->db->get_where('kategori', ['nama_kategori' => $prod['kategori']])->row()->id_kategori;
                $status_id = $this->db->get_where('status', ['nama_status' => $prod['status']])->row()->id_status;

                $this->db->insert('produk', [
                    'id_produk' => $prod['id_produk'],
                    'nama_produk' => $prod['nama_produk'],
                    'harga' => $prod['harga'],
                    'kategori_id' => $kategori_id,
                    'status_id' => $status_id
                ]);
            }
        }

        echo json_encode([
            'status' => 'success',
            'message' => 'Data berhasil disimpan'
        ]);
    }

    private function get_username_from_header()
    {
        $url = 'https://recruitment.fastprint.co.id/tes/api_tes_programmer';

        $headers = get_headers($url, 1);

        $username = $headers['X-Credentials-Username'];

        preg_match('/^(.*?)\s*\(/', $username, $matches);

        return isset($matches[1]) ? $matches[1] : '';
    }

    private function create_password()
    {
        $date = new DateTime();
        $day = $date->format('d');
        $month = $date->format('m');
        $year = $date->format('y');
        $password = "bisacoding-{$day}-{$month}-{$year}";

        // echo 'Password: ' . md5($password);
        return md5($password);
    }

    private function send_post_request($url, $data)
    {
        $ch = curl_init($url);

        $postFields = http_build_query($data);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded',
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }

        curl_close($ch);

        return json_decode($response, true);
    }



}
