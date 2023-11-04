<?php

require_once APPPATH . 'validations/Validation.php';

class ProfileValidation extends Validation
{

  private $ci;

  public function __construct()
  {
    $this->ci = &get_instance();
  }

  public function shouldValidateColumn($propertyName)
  {
    // Tambahkan aturan khusus untuk kolom yang perlu divalidasi
    $columnsToValidate = [
      'namaLengkap',
      'nomorTelepon',
      'email',
      'avatar',
      'pegawaiId'
    ];

    return in_array($propertyName, $columnsToValidate);
  }

  public function targetEntity()
  {
    return ProfileEntity::class;
  }
}
