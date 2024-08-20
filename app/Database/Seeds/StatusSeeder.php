<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i <= 2; $i++) {
            $data = [
                'status_name' => $faker->word,
                'created_at' => \CodeIgniter\I18n\Time::now(),
            ];
            $this->db->table('status')->insert($data);
        }
        
    }
}
