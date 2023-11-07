<?php
require_once APPPATH . 'interfaces/Migrator.php';
class PengaturanEntity extends Illuminate\Database\Eloquent\Model implements Migrator
{

    protected $table = "pengaturan";
    const PengaturanEntityDefinition = '
    {
        "name" : "PengaturanEntity",
        "table" : "pengaturan"
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

    private $variable;
    const VariableDefinition = '{
        "column" : "variable",
        "type" : "varchar",
        "constraint" : 64,
        "null" : false,
        "name" : "variable"
    }';

    private $value;
    const ValueDefinition = '{
        "column" : "value",
        "type" : "varchar",
        "constraint" : 556,
        "null" : false,
        "name" : "value"
    }';

    private $type;
    const TypeDefinition = '{
        "column" : "type",
        "type" : "varchar",
        "constraint" : 10,
        "null" : false,
        "name" : "type"
    }';

    private $keterangan;
    const KeteranganDefinition = '{
        "column" : "keterangan",
        "type" : "varchar",
        "constraint" : 556,
        "null" : false,
        "name" : "keterangan"
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
        $js = json_decode(self::PengaturanEntityDefinition, TRUE);
        return $js['table'];
    }
}
