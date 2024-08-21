<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'role_name' => 'admin',
                'created_at' => \CodeIgniter\I18n\Time::now(),
            ],
            [
                'role_name' => 'user',
                'created_at' => \CodeIgniter\I18n\Time::now(),
            ],
        ];
        $this->db->table('roles')->insertBatch($data);
    }
}
