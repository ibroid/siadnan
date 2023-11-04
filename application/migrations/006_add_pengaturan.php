<?php

class Migration_Add_Pengaturan extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(PengaturanEntity::table_declare());
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table(PengaturanEntity::table_name());
    }

    public function down()
    {
        $this->dbforge->drop_table(PengaturanEntity::table_name());
    }
}
