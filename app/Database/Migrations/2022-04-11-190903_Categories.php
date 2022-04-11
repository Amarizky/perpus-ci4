<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categories extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('categories', [
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
        $this->forge->modifyColumn('categories', [
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
