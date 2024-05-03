<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ReservaServicio;
use App\Models\ServicioDeSpa;

class ReservasServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $servicio = ServicioDeSpa::first();
        
        ReservaServicio::create([
            'nombre_cliente' => 'Cliente de prueba',
            'email_cliente' => 'cliente@example.com',
            'dia_servicio' => '2024-01-01',
            'hora_servicio' => '10:00:00',
            'servicio_id' => $servicio->id,
            'precio_reserva' => 50.00,
        ]);
    }
}
