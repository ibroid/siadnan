<?php

require_once APPPATH . 'interfaces/Migrator.php';

class SatkerEntity extends Illuminate\Database\Eloquent\Model implements Migrator
{
    protected $table = "satker";
    protected $guarded = [];

    const SatkerEntityDefinition = '
    {
        "name" : "SatkerEntity",
        "table" : "satker"
    }';

    private $id;
    const IdDefinition = '
    {
        "column" : "id",
        "primaryKey" : "true",
        "type" : "int",
        "constraint" : 3, 
        "null" : false,
        "name" : "id"
    }';

    private $namaSatker;
    const NamaSatkerDefinition = '
    {
        "column" : "nama_satker",
        "type" : "varchar",
        "constraint" : 191, 
        "null" : false,
        "name" : "namaSatker"   
    }';

    private $kodeSatker;
    const KodeSatkerDefinition = '{
        "column" : "kode_satker",
        "type" : "varchar",
        "constraint" : 10, 
        "null" : false,
        "name" : "kodeSatker"  
    }';

    private $teleponSatker;
    const TeleponSatkerDefinition = '{
        "column" : "telepon_satker",
        "type" : "varchar",
        "constraint" : 15, 
        "null" : false,
        "name" : "teleponSatker"  
    }';

    private $emailSatker;
    const EmailSatkerDefinition = '{
        "column" : "email_satker",
        "type" : "varchar",
        "constraint" : 90, 
        "null" : false,
        "name" : "emailSatker"
    }';

    private $logoSatker;
    const LogoSatkerDefinition = '{
        "column" : "logo_satker",
        "type" : "varchar",
        "constraint" : 64,
        "name" : "logoSatker"
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

    public $logo_path = '/uploads/logo/';

    public static $upload_path = './uploads/logo/';

    public static function table_declare()
    {;
        $reflect = new ReflectionClass(self::class);
        $field = [];

        foreach ($reflect->getConstants() as $c => $cv) {
            $rf = json_decode($cv, TRUE);

            if ($rf == null) {
                echo $cv;
            } else {
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
        }

        return $field;
    }

    public static function table_name()
    {
        $js = json_decode(self::SatkerEntityDefinition, TRUE);
        return $js['table'];
    }

    public function getLogoFullPathAttribute()
    {
        return $this->logo_path . $this->logo_satker;
    }
}
