<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i <= 9; $i++) {
            $data = [
                'brand_name' => $faker->word(),
                'created_at' => \CodeIgniter\I18n\Time::now(),
            ];
            $this->db->table('brands')->insert($data);
        }
    }
}
