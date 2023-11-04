<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function index()
	{
		$this->load->page('public/login')->layout('auth_layout');
	}
}
