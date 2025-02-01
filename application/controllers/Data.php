<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{

    public function get_data()
    {
        echo json_encode([
            'foo' => 'bar'
        ]);
    }
}
