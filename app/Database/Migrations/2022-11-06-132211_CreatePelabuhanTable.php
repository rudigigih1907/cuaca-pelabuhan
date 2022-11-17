<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePelabuhanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pelabuhan' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'nama_pelabuhan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'link_api' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id_pelabuhan', true);
        $this->forge->createTable('pelabuhan');
    }

    public function down()
    {
        $this->forge->dropTable('pelabuhan');
    }
}
