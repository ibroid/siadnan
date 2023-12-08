<?php

trait PengajuanApi
{
    private function savePengajuan(array $data = [])
    {
        $pengajuanSblmnya = PengajuanEntity::where([
            'jenis_pengajuan_id' => $data['jenis_pengajuan_id'],
            'pegawai_id' => $data['pegawai_id'],
            'status' => 1,
        ])->first();

        if ($pengajuanSblmnya) {
            throw new Exception("Pegawai ini sedang dalam proses pengajuan. Silahkan tunggu penngajuan sebelumnya selesai", 400);
        }

        return PengajuanEntity::create($data);
    }

    private function getPengajuan($id = null)
    {
        if ($id == null) {
            return PengajuanEntity::all();
        }

        return PengajuanEntity::findOrFail($id);
    }

    private function getPengajuanByJenisId($jenisPengajuanId)
    {
        return PengajuanEntity::where("jenis_pengajuan_id", $jenisPengajuanId)->get();
    }

    private function datatablePengajuan()
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

    private function uploadPengajuanSuratKeputusan($file)
    {
        $config['upload_path'] = PengajuanEntity::$upload_path;
        $config['allowed_types'] = 'pdf|docx|doc|rtf';
        $config['max_size'] = 4076;
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($file)) {
            throw new Exception($this->upload->display_errors(), 1);

        }

        return $this->upload->data("file_name");
    }


}