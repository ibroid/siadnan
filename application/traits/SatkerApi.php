<?php

trait SatkerApi
{
  public function insert_satker($data = [])
  {
    return SatkerEntity::create($data);
  }

  public function upload_logo_satker($file)
  {
    $config['upload_path'] =  SatkerEntity::$upload_path;
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size']  = '512';
    $config['encrypt_name'] = true;

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload($file)) {
      // $error = array('error' => );
      throw new Exception($this->upload->display_errors(), 1);
    } else {

      return $this->upload->data("file_name");
    }
  }

  public function get_satker($id = null)
  {
    if ($id == null) {
      return SatkerEntity::get();
    }

    return SatkerEntity::find($id);
  }

  public function update_satker(int $id = null, array $data = [])
  {
    if ($id == null) {
      throw new Exception("Gagal update satker. Id kosong", 1);
    }

    return SatkerEntity::where('id', $id)->update($data);
  }

  public function delete_satker(int $id = null)
  {
    if ($id == null) {
      throw new Exception("Gagal delete satker. Id kosong", 1);
    }

    return SatkerEntity::where('id', $id)->delete();
  }

  public function delete_logo_satker($filename)
  {
    $file_path = SatkerEntity::$upload_path . $filename;

    if (file_exists($file_path)) {
      unlink($file_path);
    }
  }
}
