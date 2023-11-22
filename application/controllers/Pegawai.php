<?php

defined("BASEPATH") or exit("Kuya Batok");

require_once APPPATH . 'traits/PegawaiApi.php';

class Pegawai extends R_Controller
{

  public function __construct()
  {
    parent::__construct(); 
    // $this->type_suggest();
  }

  use PegawaiApi;
}
