<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservaServicio extends Model
{
    use HasFactory;
    protected $table = 'reservas_servicio';
    protected $fillable = ['nombre_cliente','email_cliente','dia_servicio','hora_servicio','servicio_id','precio_reserva'];


}
