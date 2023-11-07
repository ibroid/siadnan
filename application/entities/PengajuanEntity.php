<?php

require_once APPPATH . 'interfaces/Migrator.php';

class PengajuanEntity extends Illuminate\Database\Eloquent\Model implements Migrator
{
    protected $table = "pengajuan";
    const PengajuanEntityDefinition = '{
        "name": "PengajuanEntity", 
        "table": "pengajuan"
    }';

    private $id;
    const IdDefinition = '{"column":"id","primaryKey":"true","type":"int","constraint":11,"null":false}';

    private $pegawaiId;
    const PegawaiIdDefinition = '{
        "column" : "pegawai_id",
        "type" : "int",
        "constraint" : 11,
        "null" : false,
        "name" : "pegawaiId"
    }';

    private $tanggalPengajuan;
    const TanggalPengajuanDefinition = '{
        "column" : "tanggal_pengajuan",
        "type" : "date",
        "null" : false,
        "name" : "tanggalPengajuan"
    }';

    private $jenisPengajuanId;
    const JenisPengajuanIdDefinition = '{
        "column" : "jenis_pengajuan_id",
        "constraint" : 5,
        "type" : "int",
        "null" : false,
        "name" : "jenisPengajuanId"
    }';

    private $tanggalDitinjau;
    const TanggalDitinjauDefinition = '{
        "column" : "tanggal_ditinjau",
        "type" : "date",
        "null" : false,
        "name" : "tanggalDitinjau"
    }';


    /**
     * 1 = Dalam Proses Pengajuan
     * 2 = Perlu Ditinjau Ulang
     * 3 = Pengajuan Valid
     * 4 = Pengajuan Berhasil
     * 5 = SK Sudah Terbit
     */
    private $status;
    const StatusDefinition = '{
        "column":"status",
        "type":"int",
        "constraint":1,
        "null":false,
        "default":1,
        "name":"status"
    }';

    private $asesor;
    const AsesorDefinition = '{
        "column":"asesor",
        "type":"varchar",
        "constraint":191,
        "null":false,
        "name" : "asesor"
    }';

    private $suratKeputusan;
    const SuratKeputusanDefinition = '{
        "column":"surat_keputusan",
        "type":"varchar",
        "constraint":64,
        "null":false,
        "name" : "suratKeputusan"
    }';

    private $createdAt;
    const CreatedAtDefinition = '{
        "column":"created_at",
        "type":"timestamp",
        "null":false,
        "name" : "createdAt"
    }';

    private $updatedAt;
    const UpdatedAtDefinition = '{
        "column":"updated_at",
        "type":"timestamp",
        "name" : "updatedAt"
    }';

    public static function table_declare()
    {;
        $reflect = new ReflectionClass(self::class);
        $field = [];

        foreach ($reflect->getConstants() as $c => $cv) {
            $rf = json_decode($cv, TRUE);

            if (!isset($rf['table']) && $rf !== null) {
                $rs = [];
                $rd = array_keys($rf);

                foreach ($rd as $rdn => $rdv) {
                    if ($rd[$rdn] !== 'column') {
                        if (isset($rd[$rdn])) {
                            // echo $rd[$rdn] . '<br>';
                            if ($rd[$rdn] == 'name') {
                                continue;
                            }

                            if ($rd[$rdn] == 'primaryKey') {
                                $rs['auto_increment'] = true;
                                $rs['unsigned'] = true;
                            } else {
                                $rs[$rdv] = $rf[$rdv];
                            }
                        }
                    }
                }
                $field[$rf['column']] = $rs;
            }
        }

        return $field;
    }

    public static function table_name()
    {
        $js = json_decode(self::PengajuanEntityDefinition, TRUE);
        return $js['table'];
    }
}
