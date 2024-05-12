<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\ReservaServicio;
use App\Repositories\HorarioServicioRepository;

class HorasDisponiblesTest extends TestCase
{


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHoursAvailableService()
    {
        $reservation = ReservaServicio::first();
        // devuelve las horas disponibles de un servicio teniendo en cuenta las reservas previas
        $availableHours = $this->getAvailableHoursByServiceIdAndDayService($reservation->servicio_id,$reservation->dia_servicio);
        // Verificamos que la hora de reserva existente no esté en las horas disponibles
        $this->assertNotContains($reservation->hora_servicio, $availableHours['available_times']);
    }

    /**
     * Obtiene las horas disponibles dado un service id y dia del servicio.
     *
     * @param int $servicio_id
     * @param string $dia_servicio
     * @return array
     */
    private function getAvailableHoursByServiceIdAndDayService($servicio_id, $dia_servicio)
    {
        $horarioServicioRepository = new HorarioServicioRepository();
        return $horarioServicioRepository->getAvailableHoursServiceByDate($servicio_id, $dia_servicio);
    }
}
