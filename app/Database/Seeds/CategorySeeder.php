<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Categories extends Seeder
{
    public function run()
    {
        helper('date');

        $data = [
            [
                'name'        => 'Agama',
                'alias'       => 'Religi',
                'created_at'  => now(),
                'modified_at' => NULL,
                'deleted_at'  => NULL,
            ],
            [
                'name'        => 'Aksi',
                'alias'       => NULL,
                'created_at'  => now(),
                'modified_at' => NULL,
                'deleted_at'  => NULL,
            ],
            [
                'name'        => 'Anak',
                'alias'       => NULL,
                'created_at'  => now(),
                'modified_at' => NULL,
                'deleted_at'  => NULL,
            ],
            [
                'name'        => 'Autobiografi',
                'alias'       => 'Biografi',
                'created_at'  => now(),
                'modified_at' => NULL,
                'deleted_at'  => NULL,
            ],
            [
                'name'        => 'Biografi',
                'alias'       => NULL,
                'created_at'  => now(),
                'modified_at' => NULL,
                'deleted_at'  => NULL,
            ],
            [
                'name'        => 'Bisnis',
                'alias'       => NULL,
                'created_at'  => now(),
                'modified_at' => NULL,
                'deleted_at'  => NULL,
            ],
            [
                'name'        => 'Distopia',
                'alias'       => NULL,
                'created_at'  => now(),
                'modified_at' => NULL,
                'deleted_at'  => NULL,
            ],
            [
                'name'        => 'Edukasi',
                'alias'       => 'Pengetahuan',
                'created_at'  => now(),
                'modified_at' => NULL,
                'deleted_at'  => NULL,
            ],
            [
                'name'        => 'Fantasi',
                'alias'       => 'Fiksi Ilmiah',
                'created_at'  => now(),
                'modified_at' => NULL,
                'deleted_at'  => NULL,
            ],
            [
                'name'        => 'Histori',
                'alias'       => NULL,
                'created_at'  => now(),
                'modified_at' => NULL,
                'deleted_at'  => NULL,
            ],
            [
                'name'        => 'Horror',
                'alias'       => NULL,
                'created_at'  => now(),
                'modified_at' => NULL,
                'deleted_at'  => NULL,
            ],
            [
                'name'        => 'Hukum',
                'alias'       => NULL,
                'created_at'  => now(),
                'modified_at' => NULL,
                'deleted_at'  => NULL,
            ],
            [
                'name'        => 'Komedi',
                'alias'       => 'Hiburan',
                'created_at'  => now(),
                'modified_at' => NULL,
                'deleted_at'  => NULL,
            ],
            [
                'name'        => 'Kriminal',
                'alias'       => NULL,
                'created_at'  => now(),
                'modified_at' => NULL,
                'deleted_at'  => NULL,
            ],
            [
                'name'        => 'Masakan',
                'alias'       => NULL,
                'created_at'  => now(),
                'modified_at' => NULL,
                'deleted_at'  => NULL,
            ],
            [
                'name'        => 'Misteri',
                'alias'       => 'Detektif',
                'created_at'  => now(),
                'modified_at' => NULL,
                'deleted_at'  => NULL,
            ],
            [
                'name'        => 'Motivasi',
                'alias'       => NULL,
                'created_at'  => now(),
                'modified_at' => NULL,
                'deleted_at'  => NULL,
            ],
            [
                'name'        => 'Petualangan',
                'alias'       => NULL,
                'created_at'  => now(),
                'modified_at' => NULL,
                'deleted_at'  => NULL,
            ],
            [
                'name'        => 'Politik',
                'alias'       => NULL,
                'created_at'  => now(),
                'modified_at' => NULL,
                'deleted_at'  => NULL,
            ],
            [
                'name'        => 'Romantis',
                'alias'       => NULL,
                'created_at'  => now(),
                'modified_at' => NULL,
                'deleted_at'  => NULL,
            ]
        ];

        $this->db->table('categories')->insertBatch($data);
    }
}
