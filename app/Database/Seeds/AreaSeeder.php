<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AreaSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i <= 29; $i++) {
            $data = [
                'area_name' => $faker->word(),
                'area_description' => $faker->sentence(),
                'created_at' => \CodeIgniter\I18n\Time::now(),
            ];
            $this->db->table('areas')->insert($data);
        }
    }
}
