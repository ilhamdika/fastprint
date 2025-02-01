<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    protected function load_view($view, $data = [], $title = 'Fastprint')
    {
        $this->data = array_merge($this->data, $data);
        $this->data['title'] = $title;

        $this->load->view('layouts/main', $this->data + ['content' => $view]);
    }
}
