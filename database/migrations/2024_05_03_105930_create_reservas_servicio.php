<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservas_servicio', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_cliente');
            $table->string('email_cliente');
            $table->date('dia_servicio');
            $table->time('hora_servicio');
            $table->unsignedBigInteger('servicio_id');
            $table->foreign('servicio_id')->references('id')->on('servicios_de_spa')->onDelete('cascade');
            $table->decimal('precio_reserva', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas_servicio');
    }
};
