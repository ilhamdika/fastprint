<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MY_Controller
{

	public function bisa_dijual()
	{
		$status = $this->db->select('*')->from('status')->get()->result();
		$kategori = $this->db->select('*')->from('kategori')->get()->result();

		$this->load_view('produk/bisa_dijual', [
			'status' => $status,
			'kategori' => $kategori
		]);
	}

	public function tidak_bisa_dijual()
	{
		$this->load_view('produk/tidak_bisa_dijual');
	}
}
