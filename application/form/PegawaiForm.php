<?php

require_once APPPATH . "form/FormInput.php";

class PegawaiForm extends FormInput
{
  public function targetEntity()
  {
    return PegawaiEntity::class;
  }
}
