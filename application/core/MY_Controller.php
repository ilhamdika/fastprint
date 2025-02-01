<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->data['title'] = 'My Website';
    }

    protected function load_view($view, $data = [])
    {
        $this->data = array_merge($this->data, $data);
        $this->load->view('layouts/main', $this->data + ['content' => $view]);
    }
}
