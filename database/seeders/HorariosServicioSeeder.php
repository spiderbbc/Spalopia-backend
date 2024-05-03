<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HorarioServicio;
use App\Models\ServicioDeSpa;

class HorariosServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $servicio = ServicioDeSpa::first();
        
        HorarioServicio::create([
            'dia' => '2024-01-01',
            'horario_inicio' => '10:00:00',
            'horario_fin' => '13:00:00',
            'servicio_id' => $servicio->id,
        ]);
    }
}
