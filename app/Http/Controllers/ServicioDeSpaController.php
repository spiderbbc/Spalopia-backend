<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\ServicioDeSpaRepository;


class ServicioDeSpaController extends Controller
{

    /** @var ServicioDeSpaRepository */
    private $repository;

    public function __construct(ServicioDeSpaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     */
    public function index(Request $request)
    {
        try {
            $lang = $request->route('lang');
            $servicios = $this->repository->getAllServicios($lang);
            return response()->json($servicios);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al obtener el listado de servicios'], 500);
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
