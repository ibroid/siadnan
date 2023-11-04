<?php

class Migration_Add_Users extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(UserEntity::table_declare());
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table(UserEntity::table_name());
    }

    public function down()
    {
        $this->dbforge->drop_table(UserEntity::table_name());
    }
}
