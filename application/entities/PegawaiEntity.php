<?php

require_once APPPATH . 'interfaces/Migrator.php';

class PegawaiEntity extends Illuminate\Database\Eloquent\Model implements Migrator
{

    protected $table = "pegawai";
    const PegawaiEntityDefinition = '{
        "name": "PegawaiEntity",
        "table": "pegawai"
    }';

    private $id;
    const IdDefinition = '{
        "column":"id",
        "primaryKey":"true",
        "type":"int",
        "constraint":11,
        "null":false,
        "name" : "id"
    }';

    private $namaLengkap;
    const NamaLengkapDefinition = '{
        "column" : "nama_lengkap",
        "type" : "varchar",
        "constraint" : 256,
        "null" : false,
        "name" : "namaLengkap"
    }';

    private $nip;
    const NipDefinition = '{
        "column" : "nip",
        "type" : "varchar",
        "constraint" : 20,
        "null" : false,
        "name" : "nip"
    }';

    private $jabatan;
    const JabatanDefinition = '{
        "column" : "jabatan",
        "type" : "varchar",
        "constraint" : 191,
        "null" : false,
        "name" : "jabatan"
    }';

    private $pangkat;
    const PangkatDefinition = '{
        "column" : "pangkat",
        "type" : "varchar",
        "constraint" : 74,
        "null" : false,
        "name" : "pangkat"
    }';

    private $satkerId;
    const SatkerIdDefinition = '{
        "column" : "satker_id",
        "type" : "int",
        "constraint" : 3,
        "null" : false,
        "name" : "satkerId"
    }';

    private $picture;
    const PictureDefinition = '{
        "column" : "picture",
        "type" : "varchar",
        "constraint" : 64,
        "null" : false,
        "name" : "picture"
    }';

    private $status;
    const StatusDefinition = '{
        "column" : "status",
        "type" : "int",
        "constraint" : 1,
        "null" : false,
        "default" : 1,
        "name" : "status"
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

            if (!isset($rf['table'])) {
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
        $js = json_decode(self::PegawaiEntityDefinition, TRUE);
        return $js['table'];
    }
}
