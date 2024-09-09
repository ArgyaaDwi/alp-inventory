<?php

namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i <= 30; $i++) {
            $data = [
                'name' => $faker->name(),
                'email' => $faker->email(),
                'username' => $faker->userName(),
                'password' => password_hash($faker->password(), PASSWORD_DEFAULT),
                'no_telephone' => $faker->phoneNumber(),
                'id_department' => $faker->numberBetween(1, 9),
                'created_at' => \CodeIgniter\I18n\Time::now(),
            ];
            $this->db->table('users')->insert($data);
        }
    }
}
