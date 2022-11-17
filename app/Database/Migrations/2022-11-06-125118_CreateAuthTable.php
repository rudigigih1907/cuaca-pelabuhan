<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAuthTable extends Migration
{
    public function up()
    {
        // Users
        $this->forge->addField([
            'id'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'username'         => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'fullname'         => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'nik'              => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'user_image'       => ['type' => 'varchar', 'constraint' => 255, 'default' => 'default.svg'],
            'role'             => ['type' => 'varchar', 'constraint' => 255, 'default' => 'User'],
            'password'         => ['type' => 'varchar', 'constraint' => 255],
            'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('username');
        $this->forge->addUniqueKey('nik');
        $this->forge->createTable('users', true);
    }

    public function down()
    {
        $this->forge->dropTable('users', true);
    }
}
