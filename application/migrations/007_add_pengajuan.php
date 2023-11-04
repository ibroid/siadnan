<?php

class Migration_Add_Pengajuan extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(PengajuanEntity::table_declare());
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table(PengajuanEntity::table_name());
    }

    public function down()
    {
        $this->dbforge->drop_table(PengajuanEntity::table_name());
    }
}
