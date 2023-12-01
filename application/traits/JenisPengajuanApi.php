<?php

trait JenisPengajuanApi
{
    private function addJenisPengajuan(array $data)
    {
        return JenisPengajuanEntity::create($data);
    }

    private function getJenisPengajuan($id = null)
    {
        if ($id == null) {
            return JenisPengajuanEntity::get();
        }

        return JenisPengajuanEntity::find($id);
    }

    private function updateJenisPengajuan(int $id = null, array $data = [])
    {
        if ($id == null) {
            throw new Exception("Gagal update jenis pengajuan. Id Kosong", 1);
        }

        return JenisPengajuanEntity::where("id", $id)->update($data);
    }

    private function deleteJenisPengajuan($id = null)
    {
        if ($id == null) {
            throw new Exception("Gagal delete jenis pengajuan. Id Kosong", 1);
        }

        $pengajuan = JenisPengajuanEntity::find($id);

        if (!$pengajuan) {
            throw new Exception("Gagal delete jenis pengajuan. Data not found", 1);
        }

        $persyaratan = $pengajuan->persyaratan;

        if (!empty($persyaratan->toArray())) {
            throw new Exception("Gagal delete jenis pengajuan. Masih ada persyaratan yang belum dihapus", 1);
        }

        return $pengajuan->delete();
    }
}
