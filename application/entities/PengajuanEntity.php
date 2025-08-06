<?php

use Illuminate\Database\Eloquent\Relations\BelongsTo;

require_once APPPATH . 'interfaces/Migrator.php';

class PengajuanEntity extends Illuminate\Database\Eloquent\Model implements Migrator
{
    protected $table = "pengajuan";

    protected $guarded = [];

    public $sk_path = 'uploads/berkas/';

    public static $upload_path = './uploads/berkas/';

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
        return "pengajuan";
    }

    public function pegawai()
    {
        return $this->belongsTo(PegawaiEntity::class, 'pegawai_id');
    }

    public function pengajuan()
    {
        return $this->belongsTo(JenisPengajuanEntity::class, "jenis_pengajuan_id", "id");
    }

    public function persyaratan_pengajuan()
    {
        return $this->hasMany(PersyaratanPengajuanEntity::class, "pengajuan_id", "id");
    }

    public function getTanggalPengajuanAttribute($val)
    {
        return _tanggalIndo($val);
    }

    public function getSKAttribute()
    {
        return $this->sk_path . $this->surat_keputusan;
    }
}
