<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Models\ReservaServicio;
use App\Models\HorarioServicio;
use App\Interfaces\ReservaServicioInterface;

use Carbon\Carbon;


class ReservaServicioRepository implements ReservaServicioInterface 
{
    /**
     * save reserva
     * @param array $reserva
     * @return array \App\Models\ReservaServicio  $reservaModel
     */
    public function saveReservaServicio($reserva) 
    {
        $horarioServicio = HorarioServicio::where('servicio_id', $reserva['servicio_id'])
        ->where('dia', $reserva['dia_servicio'])
        ->first();

        if (!$horarioServicio) {
            return ['error' => 'No hay horario disponible para este servicio en esta fecha.'];
        }

        $start = Carbon::parse($horarioServicio->horario_inicio);
        $end = Carbon::parse($horarioServicio->horario_fin);

        $start_time = Carbon::parse($reserva['hora_servicio']);
        $end_time = $start_time->copy()->addHour();

        // comprobamos si la hora solicitada está dentro del horario disponible del servicio
        if (!$start_time->between($start, $end) || !$end_time->between($start, $end)) { //  
            return ['error' => 'La hora solicitada no está dentro del horario disponible para este servicio en esta fecha.'];
        }

        // comprobamos si la hora solicitada ya está reservada
        $reservasExistentes = ReservaServicio::where('servicio_id', $reserva['servicio_id'])
            ->where('dia_servicio', $reserva['dia_servicio'])
            ->get();

        // validamos si la hora solicitada esta entre reservas ya guardadas en el modelo
        foreach ($reservasExistentes as $reservaExistente) {
            $hora_inicio_existente = Carbon::parse($reservaExistente->hora_servicio);
            $hora_fin_existente = $hora_inicio_existente->copy()->addHour();
            if ($start_time->addMinute()->between($hora_inicio_existente, $hora_fin_existente) || $end_time->subMinute()->between($hora_inicio_existente, $hora_fin_existente)) {
                return ['error' => 'La hora solicitada para la reserva ya fue tomada.'];
            }
        }

        $reservaModel = ReservaServicio::create($reserva);
        return $reservaModel->toArray();
    }

    


}