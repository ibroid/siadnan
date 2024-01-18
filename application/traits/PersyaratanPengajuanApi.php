<?php

trait PersyaratanPengajuanApi
{
    private function addPersyaratanPengajuan(array $data)
    {
        $berkasLama = PersyaratanPengajuanEntity::where([
            "pengajuan_id" => $data["pengajuan_id"],
            "pegawai_id" => $data["pegawai_id"],
            "persyaratan_id" => $data["persyaratan_id"],

        ])->first();

        if ($berkasLama) {
            if ($berkasLama->tanggal_diperiksa == null && $berkasLama->catatan == null) {
                throw new Exception("Berkas sebelum nya belum diperiksa. Anda bisa upload ulang saat berkas sebelumnya ditolak", 400);
            }
        }

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

    private function findPersyaratanByPengajuan($pengajuanId = null)
    {
        if ($pengajuanId == null) {
            throw new Exception("Gagal cari persyaratan berdasarkan pengajuan. Id Pengajuan Kosong", 1);
        }

        return PersyaratanPengajuanEntity::where("pengajuan", function ($q) use ($pengajuanId) {
            $q->where("id", $pengajuanId);
        })->get();
    }

    private function findPersyaratanPengajuanWhere($where = [])
    {
        return PersyaratanPengajuanEntity::where($where);
    }

    private function findPersyaratanPengajuan($id = null)
    {
        if ($id == null) {
            return PersyaratanPengajuanEntity::all();
        }
        return PersyaratanPengajuanEntity::findOrFail($id);
    }

    private function deletePersyaratanPengajuan($id = null)
    {
        if ($id == null) {
            throw new Exception("Gagal delete persyaratan pengajuan. Id Kosong", 400);
        }
        $persyaratanPengajuan = PersyaratanPengajuanEntity::find($id);

        if (file_exists(FCPATH . $persyaratanPengajuan->berkas)) {
            unlink(FCPATH . $persyaratanPengajuan->berkas);
            // throw new Exception("Gagal remove Berkas. File not found in " . $persyaratanPengajuan->berkas, 404);
        }

        $persyaratanPengajuan->delete();
    }

    private function updatePersyaratanPengajuan($id = null, array $data = [])
    {
        $persyaratanPengajuan = PersyaratanPengajuanEntity::findOrFail($id);

        $persyaratanPengajuan->update($data);

        return $persyaratanPengajuan;
    }
}
