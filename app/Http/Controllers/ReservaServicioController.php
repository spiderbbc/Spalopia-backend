<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Http\Requests\ReservaServicioPostRequest;
use App\Repositories\ReservaServicioRepository;



class ReservaServicioController extends Controller
{

    /** @var ReservaServicioRepository */
    private $repository;

    public function __construct(ReservaServicioRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     * @param ReservaServicioPostRequest $request
     * @return response
     */
    public function store(ReservaServicioPostRequest $request)
    {
        try {
            $validated = $request->safe()->only([
                'nombre_cliente',
                'email_cliente', 
                'dia_servicio',
                'hora_servicio',
                'servicio_id',
                'precio_reserva'
            ]);
            $reserva = $this->repository->saveReservaServicio($validated);
            if (array_key_exists('error', $reserva)) {
                response()->json(['message' => $reserva['error']], 422);
            }
            return response()->json(['message' => $reserva]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al guardar la reserva de servicio.'], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
