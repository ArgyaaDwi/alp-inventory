<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i <= 18; $i++) {
            $data = [
                'category_name' => $faker->word(),
                'created_at' => \CodeIgniter\I18n\Time::now(),
            ];

            $this->db->table('categories')->insert($data);
        }
    }
}
