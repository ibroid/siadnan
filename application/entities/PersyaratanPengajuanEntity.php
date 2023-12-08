<?php

require_once APPPATH . 'interfaces/Migrator.php';

class PersyaratanPengajuanEntity extends Illuminate\Database\Eloquent\Model implements Migrator
{
    protected $table = "persyaratan_pengajuan";
    protected $guarded = [];
    const PersyaratanPengajuanEntityDefinition = '{
        "name": "PersyaratanPengajuanEntity", 
        "table": "persyaratan_pengajuan"
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

    private $tanggalUpload;
    const TanggalUploadDefinition = '{
        "column" : "tanggal_upload",
        "type" : "date",
        "null" : false,
        "name" : "tanggalUpload"
    }';

    private $pengajuanId;
    const PengajuanIdDefinition = '{
        "column" : "pengajuan_id",
        "constraint" : 11,
        "type" : "int",
        "null" : false,
        "name" : "pengajuanId"
    }';

    private $persyaratanId;
    const PersyaratanIdDefinition = '{
        "column" : "persyaratan_id",
        "constraint" : 11,
        "type" : "int",
        "null" : false,
        "name" : "persyaratanId"
    }';

    private $pegawaiId;
    const PegawaiIdDefinition = '{
        "column" : "pegawai_id",
        "constraint" : 11,
        "type" : "int",
        "null" : false,
        "name" : "pegawaiId"
    }';

    private $tanggalDiperiksa;
    const TanggalDiperiksaDefinition = '{
        "column" : "tanggal_diperiksa",
        "type" : "date",
        "name" : "tanggalDiperiksa",
        "null" : true
    }';

    private $status;
    const StatusDefinition = '{
        "column" : "status",
        "type" : "int",
        "constraint" : 1,
        "null" : true,
        "name" : "status"
    }';

    private $catatan;
    const CatatanDefinition = '{
        "column" : "catatan",
        "type" : "text",
        "name" : "catatan",
        "null" : true
    }';

    // private $filename;
    const FilenameDefinition = '{
        "column" : "filename",
        "type" : "varchar",
        "constraint" : 191,
        "null" : false,
        "name" : "filename"
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


    public $file_path = 'uploads/berkas/';

    public static $upload_path = './uploads/berkas/';

    public static function table_declare()
    {
        ;
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
        $js = json_decode(self::PersyaratanPengajuanEntityDefinition, TRUE);
        return $js['table'];
    }

    public function pengajuan()
    {
        return $this->belongsTo(PengajuanEntity::class, "pengajuan_id", "id");
    }

    public function persyaratan()
    {
        return $this->belongsTo(PersyaratanEntity::class, "persyaratan_id", "id");
    }

    public function getBerkasAttribute()
    {
        return $this->file_path . $this->filename;
    }
}
