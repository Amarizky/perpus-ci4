<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Visitors extends Migration
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
            'name' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true,
            ],
            'classroom' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true,
            ],
            'visited' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'constraint'     => '11',
                'null'           => true,
            ],
            'created_at' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'constraint'     => '11',
                'null'           => true,
            ],
            'modified_at' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'constraint'     => '11',
                'null'           => true,
            ],
            'deleted_at' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'constraint'     => '11',
                'null'           => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('visitors');
    }

    public function down()
    {
        $this->forge->dropTable('visitors');
    }
}
