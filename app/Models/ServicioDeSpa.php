<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicioDeSpa extends Model
{
    use HasFactory;

    protected $table = 'servicios_de_spa';

    protected $hidden = ['traducciones'];

    /**
     * traducciones: get all traducciones 
     * 
     */
    public function traducciones()
    {
        return $this->hasMany(ServicioSpaTraduccion::class, 'servicio_id', 'id');
    }

    /**
     * horarios: get all horarios 
     * 
     */
    public function horarios()
    {
        return $this->hasMany(HorarioServicio::class, 'servicio_id', 'id');
    }
}
