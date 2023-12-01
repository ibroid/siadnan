<?php

trait PersyaratanPengajuanApi
{
    private function addPersyaratanPengajuan(array $data)
    {
        return PersyaratanPengajuanEntity::create($data);
    }

    private function uploadPersyaratanPengajuan($persyaratanId, $file)
    {

        $persyaratan = PersyaratanEntity::find($persyaratanId);

        $config['upload_path'] = PersyaratanPengajuanEntity::$upload_path;
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = $persyaratan->max_size;
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($file)) {
            throw new Exception($this->upload->display_errors(), 1);

        }

        return $this->upload->data("file_name");
    }
}