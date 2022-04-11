<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Loans extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('loans', [
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
        $this->forge->modifyColumn('loans', [
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
