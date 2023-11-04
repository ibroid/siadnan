<?php

class Migration_Add_Pegawai extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(PegawaiEntity::table_declare());
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table(PegawaiEntity::table_name());
    }

    public function down()
    {
        $this->dbforge->drop_table(PegawaiEntity::table_name());
    }
}
