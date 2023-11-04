<?php
class Debug extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        echo '<pre>';
        print_r($this->session->userdata());
    }
}
