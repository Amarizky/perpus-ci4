<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Visitors extends Migration
{
    public function up()
    {
        $this->forge->addColumn('visitors', [
            'session' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'after'          => 'visited',
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('visitors', ['session']);
    }
}
