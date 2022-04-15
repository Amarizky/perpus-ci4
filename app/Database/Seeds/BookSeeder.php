<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run()
    {
        helper('date');
        $faker = \Faker\Factory::create();
        $this->db->table('books')->truncate();

        for ($i = 0; $i < 100; $i++) {
            $sentence = $faker->sentence(5);
            $title = substr($sentence, 0, strlen($sentence) - 1);

            $data = [
                'title' => $title,
                'category_id' => $faker->numberBetween(1, 20),
                'author' => $faker->name(),
                'year' => $faker->numberBetween(1990, 2022),
                'created_at' => now(),
            ];

            $this->db->table('books')->insert($data);
        }
    }
}
