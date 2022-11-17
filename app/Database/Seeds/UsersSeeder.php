<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username'      => 'rudigigihp',
                'fullname'      => 'Rudi Gigih Prabowo',
                'nik'           => '3872-PS',
                'user_image'    => 'default.svg',
                'role'          => 'Admin',
                'password'      => password_hash('11235813', PASSWORD_BCRYPT),
            ],
            [
                'username'      => 'rudiprabowo',
                'fullname'      => 'Rudi Prabowo',
                'nik'           => '8923892',
                'user_image'    => 'default.svg',
                'role'          => 'User',
                'password'      => password_hash('11235813', PASSWORD_BCRYPT),
            ],
        ];
        $this->db->table('users')->insertBatch($data);
    }
}
