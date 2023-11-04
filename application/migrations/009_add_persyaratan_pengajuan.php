<?php

class Migration_Add_Persyaratan_Pengajuan extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(PersyaratanPengajuanEntity::table_declare());
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table(PersyaratanPengajuanEntity::table_name());
    }

    public function down()
    {
        $this->dbforge->drop_table(PersyaratanPengajuanEntity::table_name());
    }
}
