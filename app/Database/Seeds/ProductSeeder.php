<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 1; $i <= 5; $i++) {
            // Pilih id_status secara acak
            $idStatus = $faker->numberBetween(1, 3);

            // Tentukan apakah damage_description harus diisi atau tidak
            $damageDescription = ($idStatus == 2) ? $faker->sentence : null;

            $data = [
                'product_name' => $faker->word,
                'brand_name' => $faker->word,
                'description' => $faker->sentence,
                'price' => $faker->numberBetween(10000, 10000000),
                'product_image' => $faker->imageUrl(),
                'id_category' => $faker->numberBetween(1, 10),
                'id_status' => $idStatus,
                'damage_description' => $damageDescription,
                'stock' => $faker->numberBetween(1, 35),
                'created_at' => \CodeIgniter\I18n\Time::now(),
            ];

            $this->db->table('products')->insert($data);
        }
    }
}
