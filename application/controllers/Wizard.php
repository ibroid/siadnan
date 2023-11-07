<?php

class Wizard extends R_Controller
{
    public function index()
    {
        $this->load->page('user/wizard')->layout('auth_layout');
    }
}
