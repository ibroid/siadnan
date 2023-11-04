<?php

class Redirect
{
  public $url;

  public $ci;

  public function __construct()
  {
    $this->ci = &get_instance();
  }


  public static function wfa($data = [])
  {
    $red = new static;
    $red->ci->session->set_flashdata('flash_alert', $red->ci->load->component('flash_alert', $data));
    return $red;
  }

  public static function wfe($message)
  {
    $red = new static;
    $red->ci->session->set_flashdata('flash_error', $red->ci->load->component('flash_alert', [
      'type' => 'secondary',
      'mesg' => 'Terjadi Kesalahan',
      'text' => $message
    ]));

    return $red;
  }

  public function go($url = '/')
  {
    redirect($url);
  }
}
