<?php

namespace Database\Seeders;

use App\Models\Zoo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class ZooTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zoos = [
            [
                'name' => 'Zoo Quito Matriz',
                'code' => 'uio',
                'numeric_code' => 1,
                'master' => true
            ],
            [
                'name' => 'Zoo Cuenca',
                'code' => 'cuen',
                'numeric_code' => 2,
                'master' => false
            ],
            [
                'name' => 'Zoo Guayaquil',
                'code' => 'gye',
                'numeric_code' => 3,
                'master' => false
            ],
        ];

        foreach ($zoos as $zoo)
            Zoo::create($zoo);
    }
}
