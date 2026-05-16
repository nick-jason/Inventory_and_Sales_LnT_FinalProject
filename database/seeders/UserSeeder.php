<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'        => 'Admin',
            'admin_id'    => '0001',
            'email'       => 'admin@gmail.com',
            'password'    => bcrypt('11223344'),
            'phone_number'=> '081223344556',
            'role'        => 'admin',
            'address'     => null,
            'postal_code' => null,
        ]);
        
        User::create([
            'name'        => 'Budi',
            'admin_id'    => null,
            'email'       => 'budi123@gmail.com',
            'password'    => bcrypt('11223344'),
            'phone_number'=> '081234567890',
            'role'        => 'user',
            'address'     => 'Jl. Kyai H. Syahdan, Kec. Palmerah, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta',
            'postal_code' => '11480',
        ]);
    }
}
