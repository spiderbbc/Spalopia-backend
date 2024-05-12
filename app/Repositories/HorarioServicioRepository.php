<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Models\ServicioDeSpa;
use App\Interfaces\HorarioServicioInterface;

use App\Models\ReservaServicio;
use App\Models\HorarioServicio;
use Carbon\Carbon;

class HorarioServicioRepository implements HorarioServicioInterface 
{
    /**
     * Get Available Hours Service By Date 
     * @param int $service_id
     * @param string $date
     * @return array 
     */
    public function getAvailableHoursServiceByDate($service_id, $date) 
    {

        $available_times = HorarioServicio::where('servicio_id', $service_id)
            ->where('dia', $date) 
            ->first(); 
        
        if (!$available_times) {
            return ['error' => 'No hay servicio o horario disponible en esta fecha.'];
        }
       
        $inicio = Carbon::parse($available_times->horario_inicio);
        $fin = Carbon::parse($available_times->horario_fin);

        $horas_en_rango = [];

        // creamos lista de horas entre hora inicio y final
        while ($inicio->lte($fin)) {
            $horas_en_rango[] = $inicio->format('H:i:s');
            $inicio->addHour();
        }

        $primer_elemento = reset($horas_en_rango);
        $ultimo_elemento = end($horas_en_rango);
        // obtenemos las reservas
        $reservas = ReservaServicio::whereBetween('hora_servicio', [$primer_elemento, $ultimo_elemento])->where('servicio_id', $service_id)->get();
        
        $horas_disponibles = $horas_en_rango;
        // Iterar sobre las reservas y eliminar las horas 
        foreach ($reservas as $reserva) {
            $hora_fin_reserva = Carbon::parse($reserva->hora_servicio)->addHour()->format('H:i:s'); 
            foreach ($horas_disponibles as $key => $hora) {
                if ($hora >= $reserva->hora_servicio && $hora <= $hora_fin_reserva) {
                    unset($horas_disponibles[$key]);
                }
            }
        }
        
        return [
            'servicio_id' => $service_id,
            'date' => $date,
            'available_times' => array_values($horas_disponibles),
        ];
    }

    


}