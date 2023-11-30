<?php

trait PersyaratanApi
{
    private function getPersyaratan($id = null, $pengajuanId = null)
    {
        if ($pengajuanId == null) {
            throw new Exception("Gagal get persyaratan. pengajuan_id kosong", 1);
        }
        if ($id == null) {
            return PersyaratanEntity::where("pengajuan_id", $pengajuanId)->get();
        }

        return PersyaratanEntity::find($id);
    }

    private function addPersyaratan(array $data = [])
    {
        if (empty(array_keys($data))) {
            throw new Exception("Gagal add ppersyaratan. data kosong", 1);
        }

        return PersyaratanEntity::create($data);
    }

    private function updatePersyaratan(int $id = null, $data = [])
    {
        if ($id == null) {
            throw new Exception("Gagal update persyaratan. id kosong", 1);
        }

        return PersyaratanEntity::where("id", $id)->update($data);
    }

    private function deletePersyaratan(int $id = null)
    {
        if ($id == null) {
            throw new Exception("Gagal update persyaratan. id kosong", 1);
        }

        return PersyaratanEntity::where("id", $id)->delete();
    }
}
