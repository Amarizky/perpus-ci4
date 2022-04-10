<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 100; $i++) {
            $sentence = $faker->sentence(5);
            $name = substr($sentence, 0, strlen($sentence) - 1);

            $data = [
                'name' => $name,
                'category_id' => $faker->numberBetween(0, 20),
                'author' => $faker->name(),
                'year' => $faker->numberBetween(1990, 2022),
            ];

            $this->db->table('books')->insert($data);
        }
    }
}
