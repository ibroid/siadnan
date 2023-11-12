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

  private function insert_pegawai($data = [])
  {
    return PegawaiEntity::create($data);
  }

  public function datatable_pegawai()
  {
    $columns = ['nama_lengkap', 'nip', 'jabatan', 'pangkat',  'status', 'picture'];

    $draw = isset($_POST['draw']) ? $_POST['draw'] : 0;
    $start = isset($_POST['start']) ? $_POST['start'] : 0;
    $length = isset($_POST['length']) ? $_POST['length'] : 10;
    $orderColumn = isset($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : 0;
    $column = $columns[$orderColumn];
    $dir = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'asc';

    $pegawai = PegawaiEntity::select($columns)
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
      $row_container[$n]['status'] = $this->load->component('badge_status_pegawai',  ['status' => $p->status]);
      $row_container[$n]['foto'] = $this->load->component('button_view_pas_foto');
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
    $config['max_size']  = '512';
    $config['encrypt_name'] = true;

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload($file)) {
      throw new Exception($this->upload->display_errors(), 1);
    } else {
      return $this->upload->data('file_name');
    }
  }
}
