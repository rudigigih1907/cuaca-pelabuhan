<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIsMonitoredToPortsTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('ports', [
            'is_monitored' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
                'after'      => 'province',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('ports', 'is_monitored');
    }
}
