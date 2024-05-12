<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServicioDeSpa;
use App\Models\ServicioSpaTraduccion;

class ServiciosDeSpaTraduccionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $servicio = ServicioDeSpa::first();
        
        ServicioSpaTraduccion::create([
            'servicio_id' => $servicio->id,
            'locale' => 'eng',
            'nombre' => 'Back massage',
        ]);

        ServicioSpaTraduccion::create([
            'servicio_id' => $servicio->id,
            'locale' => 'pt',
            'nombre' => 'Massagem nas costas',
        ]);

        ServicioSpaTraduccion::create([
            'servicio_id' => $servicio->id,
            'locale' => 'it',
            'nombre' => 'Massaggio alla schiena',
        ]);


        ServicioSpaTraduccion::create([
            'servicio_id' => $servicio->id,
            'locale' => 'fr',
            'nombre' => 'Massage du dos',
        ]);
    }
}
