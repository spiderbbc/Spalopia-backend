<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Models\ServicioDeSpa;
use App\Interfaces\ServicioDeSpaInterface;

class ServicioDeSpaRepository implements ServicioDeSpaInterface 
{
    /**
     * List all servicios
     * @return App\Models\ServicioDeSpa  $servicios
     */
    public function getAllServicios($locale = null) 
    {
        $servicios = ServicioDeSpa::with('horarios')->get();
        if (!is_null($locale)) {
            $servicios = ServicioDeSpa::with(['horarios','traducciones' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }])->get();

            foreach ($servicios as $servicio) {
                $servicio->nombre_traducido = $servicio->traducciones->first()->nombre ?? null;
            }
        }
        return $servicios;
    }

    


}