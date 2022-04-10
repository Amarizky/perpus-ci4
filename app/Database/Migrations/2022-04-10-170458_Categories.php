<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categories extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => '11',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true,
            ],
            'alias'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true,
            ],
            'created_at' => [
                'type'           => 'INT',
                'constraint'     => '11',
                'unsigned'       => true,
                'null'           => true,
            ],
            'modified_at' => [
                'type'           => 'INT',
                'constraint'     => '11',
                'unsigned'       => true,
                'null'           => true,
            ],
            'deleted_at' => [
                'type'           => 'INT',
                'constraint'     => '11',
                'unsigned'       => true,
                'null'           => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('categories');
    }

    public function down()
    {
        $this->forge->dropTable('categories');
    }
}
