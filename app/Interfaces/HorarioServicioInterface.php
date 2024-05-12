<?php

namespace App\Interfaces;

interface HorarioServicioInterface
{
    /**
     * Get all horas disponibles
     * 
     * @method  GET horas-disponibles
     * @access  public
     */
    public function getAvailableHoursServiceByDate($service_id, $date);

    
}