<?php

trait PengajuanApi
{
    private function savePengajuan(array $data = [])
    {
        return PengajuanEntity::create($data);
    }

    function getPengajuan($id = null)
    {
        if ($id == null) {
            return PengajuanEntity::all();
        }

        return PengajuanEntity::find($id);
    }

    public function getPengajuanByJenisId($jenisPengajuanId)
    {
        return PengajuanEntity::where("jenis_pengajuan_id", $jenisPengajuanId)->get();
    }
}