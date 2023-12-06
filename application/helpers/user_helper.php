<?php

if (!function_exists('_getLevel')) {
    function _getLevel(int $var): string
    {
        switch ($var) {
            case 1:
                return "Developer";
                break;
            case 2:
                return "Administrator";
                break;
            default:
                return "Operator";
                break;
        }
    }
}

if (!function_exists('_tanggalIndo')) {
    function _tanggalIndo(string $tanggal): string
    {
        $bulan = array(
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
    }
}


