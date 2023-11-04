<?php

class Wizard extends CI_Controller
{
    public function index()
    {
        $this->load->page('user/wizard')->layout('auth_layout');
    }
}
