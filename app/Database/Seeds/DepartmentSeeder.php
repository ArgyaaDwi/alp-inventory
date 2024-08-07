<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i <= 8; $i++) {
            $data = [
                'department_name' => $faker->word(),
                'created_at' => \CodeIgniter\I18n\Time::now(),
            ];

            $this->db->table('departments')->insert($data);
        }
    }
}
