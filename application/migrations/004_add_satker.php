<?php

class Migration_Add_Satker extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(SatkerEntity::table_declare());
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table(SatkerEntity::table_name());
    }

    public function down()
    {
        $this->dbforge->drop_table(SatkerEntity::table_name());
    }
}
