<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioServicio extends Model
{
    use HasFactory;
    protected $table = 'horarios_servicio';


    public function servicio()
    {
        return $this->belongsTo(ServicioDeSpa::class, 'servicio_id', 'id');
    }
}
