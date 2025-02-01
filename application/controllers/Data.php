<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{
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

        echo json_encode($response);
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

        echo 'Password: ' . md5($password);
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
