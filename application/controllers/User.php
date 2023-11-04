<?php

defined("BASEPATH") or die("Kuya batok");

require_once APPPATH . 'traits/UserApi.php';

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    use UserApi;

    public function index()
    {
        $this->load->page("user/dashboard")->layout('dashboard_layout');
    }
}
