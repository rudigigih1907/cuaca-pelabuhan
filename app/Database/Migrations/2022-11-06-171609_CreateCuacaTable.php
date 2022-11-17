<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCuacaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_cuaca'      => ['type' => 'INT','constraint' => 11,'unsigned' => TRUE,'auto_increment' => TRUE],
            'name'          => ['type' => 'VARCHAR','constraint' => 255],
            'issued'        => ['type' => 'DATETIME','null' => TRUE],
            'valid_from'    => ['type' => 'DATETIME','null' => TRUE],
            'valid_to'      => ['type' => 'DATETIME','null' => TRUE],
            'weather'       => ['type' => 'VARCHAR','constraint' => 255],
            'temp_min'      => ['type' => 'VARCHAR','constraint' => 10,'null' => TRUE],
            'temp_max'      => ['type' => 'VARCHAR','constraint' => 10,'null' => TRUE],
            'rh_min'        => [ 'type' => 'VARCHAR','constraint' => 10,'null' => TRUE],
            'rh_max'        => ['type' => 'VARCHAR','constraint' => 10,'null' => TRUE],
            'ket_tambahan'  => ['type' => 'TEXT','null' => TRUE,],
            'created_at'    => ['type' => 'DATETIME'],
            'updated_at'    => ['type' => 'DATETIME'],
            'deleted_at'    => ['type' => 'DATETIME'],
        ]);
        $this->forge->addKey('id_cuaca', true);
        $this->forge->createTable('cuaca');
    }
    public function down()
    {
        $this->forge->dropTable('cuaca');
    }
}
