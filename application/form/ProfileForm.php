<?php

require_once APPPATH . "form/FormInput.php";

class ProfileForm extends FormInput
{
  public function targetEntity()
  {
    return ProfileEntity::class;
  }

  public static function optionsSelectSatkerId()
  {
    $satkers = SatkerEntity::all();
    $options = [];

    foreach ($satkers as $satker) {
      $option = new stdClass;
      $option->{$satker->id} = $satker->namaSatker;
      array_push($options, $option);
    }

    return $option;
  }
}
