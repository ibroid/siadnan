<?php

require_once APPPATH . "form/FormInput.php";

class SatkerForm extends FormInput
{
  public function targetEntity()
  {
    return SatkerEntity::class;
  }
}
