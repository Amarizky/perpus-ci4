<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admins extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('admins', ['last_login']);
        $this->forge->addColumn('admins', [
            'session' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'after'          => 'password',
            ]
        ]);
        $this->forge->modifyColumn('admins', [
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
        $this->forge->dropColumn('admins', ['session']);
        $this->forge->addColumn('admins', [
            'last_login' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'constraint'     => '11',
                'null'           => true,
                'after'          => 'password',
            ],
        ]);
        $this->forge->modifyColumn('admins', [
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
