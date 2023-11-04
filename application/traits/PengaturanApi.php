<?php

trait PengaturanApi
{
  public function get_pengaturan($variable = null)
  {
    if ($variable == null) {
      throw new Exception("Gagal get Pengaturan. Variabel kosong", 1);
    }

    return PengaturanEntity::where('variable', $variable)->first();
  }

  public function update_pengaturan($var = null, $val = null)
  {
    if ($var == null) {
      throw new Exception("Gagal Update Pengaturan. Variabel kosong", 1);
    }

    if ($val == null) {
      throw new Exception("Gagal Update Pengaturan. Value kosong", 1);
    }

    return PengaturanEntity::where('variable', $var)->update(['value' => $val]);
  }
}
