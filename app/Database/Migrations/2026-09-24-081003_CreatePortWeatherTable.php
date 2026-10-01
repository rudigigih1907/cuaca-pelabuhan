<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePortWeatherTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'port_code' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
            ],
            'forecast_time' => [
                'type' => 'DATETIME',
            ],
            'weather' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'visibility' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'temp_avg' => [
                'type'       => 'FLOAT',
                'null'       => true,
            ],
            'rh_avg' => [
                'type'       => 'FLOAT',
                'null'       => true,
            ],
            'wind_from' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'wind_speed' => [
                'type'       => 'FLOAT',
                'null'       => true,
            ],
            'wind_gust' => [
                'type'       => 'FLOAT',
                'null'       => true,
            ],
            'wave_cat' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'wave_height' => [
                'type'       => 'FLOAT',
                'null'       => true,
            ],
            'current_to' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'current_speed' => [
                'type'       => 'FLOAT',
                'null'       => true,
            ],
            'tides' => [
                'type'       => 'FLOAT',
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);

        // Mencegah duplikasi data cuaca pada pelabuhan & jam yang sama
        $this->forge->addUniqueKey(['port_code', 'forecast_time']);
        $this->forge->addForeignKey('port_code', 'ports', 'code', 'CASCADE', 'CASCADE', 'fk_port_code_port_weather');
        $this->forge->createTable('port_weathers');
    }

    public function down()
    {
        $this->forge->dropForeignKey('port_weather', 'fk_port_code_port_weather');
        $this->forge->dropTable('port_weathers');
    }
}
