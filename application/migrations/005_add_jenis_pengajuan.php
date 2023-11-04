<?php

class Migration_Add_Jenis_Pengajuan extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(JenisPengajuanEntity::table_declare());
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table(JenisPengajuanEntity::table_name());
    }

    public function down()
    {
        $this->dbforge->drop_table(JenisPengajuanEntity::table_name());
    }
}
