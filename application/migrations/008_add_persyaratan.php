<?php

class Migration_Add_Persyaratan extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(PersyaratanEntity::table_declare());
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table(PersyaratanEntity::table_name());
    }

    public function down()
    {
        $this->dbforge->drop_table(PersyaratanEntity::table_name());
    }
}
