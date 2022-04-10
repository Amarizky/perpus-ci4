<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admins extends Migration
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
            'username' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'password' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'last_login' => [
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
        $this->forge->createTable('admins');
    }

    public function down()
    {
        $this->forge->dropTable('admins');
    }
}
