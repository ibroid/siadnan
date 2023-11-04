<?php

require_once APPPATH . 'interfaces/Migrator.php';

class ProfileEntity extends Illuminate\Database\Eloquent\Model implements Migrator
{
	protected $table = "profile";
	protected $guarded = [];

	const ProfileEntityDefinition = '{"name": "ProfileEntity", "table": "profile"}';

	private $id;
	const IdDefinition = '{
		"column":"id",
		"primaryKey":"true",
		"type":"int",
		"constraint":5,
		"null":false,
		"name" : "id"
	}';

	private $nama_lengkap;
	const NamaLengkapDefinition = '{
		"column":"nama_lengkap",
		"type":"varchar",
		"constraint":191,
		"null":false,
		"name" : "nama_lengkap"
	}';

	private $nomor_telepon;
	const NomorTeleponDefinition = '{
		"column":"nomor_telepon",
		"type":"varchar",
		"constraint":15,
		"null":false,
		"name" : "nomor_telepon"
	}';

	private $email;
	const EmailDefinition = '{
		"column":"email",
		"type":"varchar",
		"constraint":64,
		"null":false,
		"name" : "email"
	}';

	private $avatar;
	const AvatarDefinition = '{
		"column":"avatar",
		"type":"varchar",
		"constraint":64,
		"name" : "avatar"
	}';

	private $pegawai_id;
	const PegawaiIdDefinition = '{
		"column":"pegawai_id",
		"type":"int",
		"constraint":11,
		"name" : "pegawai_id"
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
		$js = json_decode(self::ProfileEntityDefinition, TRUE);
		return $js['table'];
	}

	public function pegawai()
	{
		return $this->belongsTo(PegawaiEntity::class);
	}
}
