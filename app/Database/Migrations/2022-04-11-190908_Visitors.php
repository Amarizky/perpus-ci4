<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Visitors extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('visitors', [
            'modified_at' => [
                'name'           => 'updated_at',
                'type'           => 'INT',
                'constraint'     => '11',
                'unsigned'       => true,
                'null'           => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('visitors', [
            'updated_at' => [
                'name'           => 'modified_at',
                'type'           => 'INT',
                'constraint'     => '11',
                'unsigned'       => true,
                'null'           => true,
            ],
        ]);
    }
}
