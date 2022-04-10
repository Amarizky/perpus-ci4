<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        helper('date');

        $data = [
            'username' => 'admin',
            'password' => password_hash('admin', PASSWORD_BCRYPT),
            'created_at' => now()
        ];
        $this->db->table('admins')->insert($data);
    }
}
