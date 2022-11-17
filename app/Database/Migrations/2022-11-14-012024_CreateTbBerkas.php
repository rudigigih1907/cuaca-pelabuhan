<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTbBerkas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_berkas'      => ['type' => 'INT','constraint' => 11,'unsigned' => TRUE,'auto_increment' => TRUE],
            'cuaca_id'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE],
            'berkas'         => ['type' => 'VARCHAR', 'constraint' => 255],
            'keterangan'     => ['type' => 'TEXT', 'null' => TRUE],
            'created_at'     => ['type' => 'DATETIME'],
            'updated_at'     => ['type' => 'DATETIME'],
            'deleted_at'     => ['type' => 'DATETIME'],
        ]);
        $this->forge->addKey('id_berkas', true);
        $this->forge->addForeignKey('cuaca_id', 'cuaca', 'id_cuaca','CASCADE', 'CASCADE');
        $this->forge->createTable('berkas');
    }

    public function down()
    {
        $this->forge->dropForeignKey('berkas', 'berkas_cuaca_id_foreign');
        $this->forge->dropTable('berkas');
    }
}
