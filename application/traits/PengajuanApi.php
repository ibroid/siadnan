<?php

trait PengajuanApi
{
    private function savePengajuan(array $data = [])
    {
        return PengajuanEntity::create($data);
    }
}