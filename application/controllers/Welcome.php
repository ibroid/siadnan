<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends R_Controller
{
	public function index()
	{
		$this->load->page('public/login')->layout('auth_layout');
	}
}
