<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categories extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('categories', ['alias']);
    }

    public function down()
    {
        $this->forge->addColumn('categories', [
            'alias'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true,
            ],
        ]);
    }
}
