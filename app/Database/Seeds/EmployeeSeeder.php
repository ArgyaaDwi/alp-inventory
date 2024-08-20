<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i <= 30; $i++) {
            $data = [
                'employee_badge' => $faker->numberBetween(4000, 5000),
                'employee_name' => $faker->name(),
                'employee_address' => $faker->address(),
                'employee_position' => $faker->jobTitle(),
                'employee_email' => $faker->email(),
                'employee_phone' => $faker->phoneNumber(),
                'employee_image' => $faker->imageUrl(),
                'id_department' => $faker->numberBetween(1, 9),
                'is_active' => $faker->boolean(1),
                'created_at' => \CodeIgniter\I18n\Time::now(),



            ];

            $this->db->table('employees')->insert($data);
        }
    }
}