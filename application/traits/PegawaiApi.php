<?php

trait PegawaiApi
{
  public function type_suggest()
  {
    $query = R_Input::gett('query');
    $satker_id = R_Input::gett('satker_id');
    $data = PegawaiEntity::select('id', 'nama_lengkap')
      ->where('satker_id', $satker_id)
      ->where('nama_lengkap', 'LIKE', "$query%")
      ->get();

    echo json_encode($data);
  }
}
