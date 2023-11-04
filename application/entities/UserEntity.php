<?php

use Illuminate\Database\Eloquent\Relations\BelongsTo;

require_once APPPATH . 'interfaces/Migrator.php';

class UserEntity extends Illuminate\Database\Eloquent\Model implements Migrator
{
    protected $table = "user";
    protected $guarded = [];
    const UserEntityDefinition = '{"name": "UserEntity", "table": "user"}';

    private $id;
    const IdDefinition = '{
        "column" : "id",
        "primaryKey" : "true",
        "type" : "int",
        "constraint" : 2,
        "null" : false,
        "name" : "id"
    }';

    private $identifier;
    const IdentifierDefinition = '{
        "column":"identifier",
        "type":"varchar",
        "constraint":64,
        "null":false,
        "name" : "identifier"
    }';

    private $password;
    const PasswordDefinition = '{
        "column":"password",
        "type":"varchar",
        "constraint":191,
        "null":false,
        "name" : "password"
    }';

    private $status;
    const StatusDefinition = '{
        "column":"status",
        "type":"int",
        "constraint":1,
        "null":false,
        "default":1,
        "name" : "status"
    }';

    private $level;
    const LevelDefinition = '{
        "column":"level",
        "type":"int",
        "constraint":1,
        "null":false,
        "default":2,
        "name" : "level"
    }';

    private $salt;
    const SaltDefinition = '{
        "column":"salt",
        "type":"varchar",
        "constraint":64,
        "null":false,
        "name" : "salt"
    }';

    private $profile_id;
    const ProfileIdDefinition = '{
        "column":"profile_id",
        "type":"int",
        "constraint":5,
        "null":false,
        "name" : "profile_id"
    }';

    private $created_at;
    const CreatedAtDefinition = '{
        "column":"created_at",
        "type":"timestamp",
        "null":false,
        "name" : "created_at"
    }';

    private $updated_at;
    const UpdatedAtDefinition = '{
        "column":"updated_at",
        "type":"timestamp",
        "name" : "updated_at"
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
        $js = json_decode(self::UserEntityDefinition, TRUE);
        return $js['table'];
    }

    public function getLevelAttribute($value)
    {
        return _getLevel($value);
    }

    public function getStatusAttribute($value)
    {
        return ($value == 1) ? 'Active' : 'Inactive';
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = password_hash($value . $this->attributes['salt'], PASSWORD_BCRYPT);
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(ProfileEntity::class);
    }
}
