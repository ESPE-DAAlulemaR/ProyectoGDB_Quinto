<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Zoo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $uio = Zoo::where('code', 'uio')->first();
        $cuen = Zoo::where('code', 'cuen')->first();
        $gye = Zoo::where('code', 'gye')->first();

        $users = [
            [
                'zoo_id' => $uio->id,
                'name' => 'Dannyel Alulema',
                'email' => 'daalulema2@espe.edu.ec',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'zoo_id' => $cuen->id,
                'name' => 'Nataly Pacheco',
                'email' => 'nmpacheco1@espe.edu.ec',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'zoo_id' => $gye->id,
                'name' => 'Dannyel Alulema',
                'email' => 'jomanzaba@espe.edu.ec',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        foreach ($users as $user)
            User::create($user);
    }
}
