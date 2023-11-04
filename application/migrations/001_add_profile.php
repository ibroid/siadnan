<?php

class Migration_Add_Profile extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(ProfileEntity::table_declare());
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table(ProfileEntity::table_name());
    }

    public function down()
    {
        $this->dbforge->drop_table(ProfileEntity::table_name());
    }
}
