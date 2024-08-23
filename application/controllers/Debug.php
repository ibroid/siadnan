<?php
class Debug extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('EloquentDatabase');
    }

    public function index()
    {
        show_404();
    }
}
