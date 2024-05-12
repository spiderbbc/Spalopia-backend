<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\HorarioServicioRepository;

use Carbon\Carbon;

class HorarioServicioController extends Controller
{

    /** @var HorarioServicioRepository */
    private $repository;

    public function __construct(HorarioServicioRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource horarios by $servicio_id, $fecha .
     * @param Request $request
     * @param int $servicio_id
     * @param string $fecha
     * @return response
     */
    public function index(Request $request, $servicio_id, $fecha)
    {
        try {
            $horarios = $this->repository->getAvailableHoursServiceByDate($servicio_id, $fecha);
            return response()->json(['horarios' => $horarios]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al guardar la reserva de servicio.'], 500);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
