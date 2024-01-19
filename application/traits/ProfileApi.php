<?php

trait ProfileApi
{
  public function suggest_autocomplete()
  {
    $query = R_Input::gett('query');
    $data = ProfileEntity::select('id', 'nama_lengkap')
      ->where('nama_lengkap', 'LIKE', "$query%")
      ->get();

    echo json_encode($data);
  }

  public function suggest_autocomplete_with_pegawai()
  {
    $query = R_Input::gett('query');
    $data = ProfileEntity::select('id', 'nama_lengkap')
      ->where('nama_lengkap', 'LIKE', "$query%")
      ->where('pegawai_id', '!=', 0)
      ->get();

    echo json_encode($data);
  }

  public function get_profile($id = null)
  {
    if ($id == null) {
      return ProfileEntity::get();
    }

    return ProfileEntity::where('id', $id)->first();
  }

  public function insert_profile($data = [])
  {
    return ProfileEntity::create($data);
  }

  public function update_profile($id = null, $data = [])
  {
    if ($id == null) {
      throw new Exception("Gagal update profile. Id tidak ada.", 1);
    }

    return ProfileEntity::where('id', $id)->update($data);
  }

  public function delete_profile($id = null)
  {
    if ($id == null) {
      throw new Error("Gagal delete profile. Id tidak ada.", 1);
    }

    $cekUsedUser = UserEntity::where('profile_id', $id)->first();

    if ($cekUsedUser) {
      throw new Exception("Profile masih digunakan oleh user : " . $cekUsedUser->identifier, 1);
    }

    return ProfileEntity::where('id', $id)->delete();
  }
}
