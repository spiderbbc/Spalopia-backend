<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServicioDeSpa;

class ServiciosDeSpaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServicioDeSpa::create([
            'nombre' => 'Masaje de espalda',
            'precio' => 50.00,
        ]);
    }
}
