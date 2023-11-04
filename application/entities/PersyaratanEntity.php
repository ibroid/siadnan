<?php

require_once APPPATH . 'interfaces/Migrator.php';

class PersyaratanEntity extends Illuminate\Database\Eloquent\Model implements Migrator
{

    protected $table = "persyaratan";
    const PersyaratanEntityDefinition = '
    {
        "name" : "PersyaratanEntity",
        "table" : "persyaratan"
    }';

    private $id;
    const IdDefinition = '{
        "column":"id",
        "primaryKey":"true",
        "type":"int",
        "constraint":5,
        "null":false,
        "name" : "id"
    }';

    private $persyaratan;
    const PersyaratanDefinition = '{
        "column" : "persyaratan",
        "type" : "varchar",
        "constraint" : 191,
        "null" : false,
        "name" : "persyaratan"
    }';

    private $detail;
    const DetailDefinition = '{
        "column" : "detail",
        "type" : "text",
        "null" : false,
        "name" : "detail"
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
        $js = json_decode(self::PersyaratanEntityDefinition, TRUE);
        return $js['table'];
    }
}
