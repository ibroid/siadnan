<?php

trait PegawaiApi
{
  public function type_suggest()
  {
    $query = R_Input::gett('query');
    $satker_id = R_Input::gett('satker_id');

    if ($satker_id != null) {
      $data = PegawaiEntity::select('id', 'nama_lengkap')
        ->where('satker_id', $satker_id)
        ->where('nama_lengkap', 'LIKE', "$query%")->get();
    } else {
      $data = PegawaiEntity::select('id', 'nama_lengkap')->where('nama_lengkap', 'LIKE', "$query%")->get();
    }


    echo json_encode($data);
  }

  private function insert_pegawai($data = [])
  {
    return PegawaiEntity::create($data);
  }

  public function datatable_pegawai($idSatker)
  {
    $columns = ['id', 'nama_lengkap', 'nip', 'jabatan', 'pangkat', 'status', 'picture'];

    $draw = isset($_POST['draw']) ? $_POST['draw'] : 0;
    $start = isset($_POST['start']) ? $_POST['start'] : 0;
    $length = isset($_POST['length']) ? $_POST['length'] : 10;
    $orderColumn = isset($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : 0;
    $column = $columns[$orderColumn];
    $dir = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'asc';

    $pegawai = PegawaiEntity::select($columns)
      ->where("satker_id", $idSatker)
      ->orderBy($column, $dir)
      ->offset($start)
      ->limit($length)
      ->get();

    $total_pegawai = PegawaiEntity::count();

    $row_container = [];

    foreach ($pegawai as $n => $p) {
      $row_container[$n]['nama'] = $p->nama_lengkap;
      $row_container[$n]['nip'] = $p->nip;
      $row_container[$n]['jabatan'] = $p->jabatan;
      $row_container[$n]['pangkat'] = $p->pangkat;
      $row_container[$n]['status'] = $this->load->component('badge_status_pegawai', ['status' => $p->status]);
      $row_container[$n]['foto'] = $this->load->component('button_view_pas_foto', ['id' => $p->id]);
      $row_container[$n]['action'] = $this->load->component('button_action_pegawai', ['id' => $p->id, 'satker_id' => $idSatker]);
    }

    header("Content-Type: application/json", true, 200);

    echo json_encode([
      'draw' => $draw,
      'recordsTotal' => $total_pegawai,
      'recordsFiltered' => $total_pegawai,
      'data' => $row_container
    ]);
  }

  private function upload_pass_foto($file = null)
  {

    $config['upload_path'] = PegawaiEntity::$upload_path;
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size'] = '512';
    $config['encrypt_name'] = true;

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload($file)) {
      throw new Exception($this->upload->display_errors(), 1);
    } else {
      return $this->upload->data('file_name');
    }
  }

  private function passFoto($id = null)
  {
    if ($id == null) {
      throw new Exception("Gagal ambil pass foto. Id kosong", 1);
    }

    $pegawai = PegawaiEntity::find($id);

    if ($pegawai->picture == "nopic") {
      // set_status_header(400, "Pegawai tidak mempunyai pass foto");
      throw new Exception("Pegawai tidak mempunyai pass foto", 400);
    }

    return $pegawai->passfoto;
  }

  private function getPegawai($id = null)
  {
    if ($id == null) {
      throw new Exception("Gagal ambil  pegawai. Id kosong", 1);
    }

    return PegawaiEntity::find($id);
  }

  private function updatePegawai($id = null, $data = [])
  {
    if ($id == null) {
      throw new Exception("Gagal update  pegawai. Id kosong", 1);
    }

    return PegawaiEntity::where("id", $id)->update($data);
  }

  private function deleteUser($id = null)
  {
    if ($id == null) {
      throw new Exception("Gagal delete pegawai. Id kosong", 1);
    }

    return PegawaiEntity::where("id", $id)->delete();
  }
}
