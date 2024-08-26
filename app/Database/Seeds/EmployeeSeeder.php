<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i <= 9; $i++) {
            $data = [
                'employee_badge' => $faker->numberBetween(4000, 5000),
                'employee_name' => $faker->name(),
                'employee_address' => $faker->address(),
                'employee_position' => $faker->jobTitle(),
                'employee_email' => $faker->email(),
                'employee_password' => 123456,
                'employee_phone' => $faker->phoneNumber(),
                'employee_image' => $faker->imageUrl(),
                'id_department' => $faker->numberBetween(1, 19),
                'id_role' => 2,
                'is_active' =>  1,
                'created_at' => \CodeIgniter\I18n\Time::now(),
            ];

            $this->db->table('employees')->insert($data);
        }
    }
}
