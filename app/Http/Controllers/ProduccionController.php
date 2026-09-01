<?php

namespace App\Http\Controllers;


use App\Services\ProduccionService;
use App\Http\Requests\Produccion\StoreProduccionRequest;
use App\Http\Requests\Produccion\UpdateProduccionRequest;
use App\Models\Produccion;


class ProduccionController extends Controller
{
    public function __construct(private ProduccionService $produccionService)
    {}
     public function index()
     {
        return response()->json([
            'success' => 'Se listaron correctamente',
            'data'  => $this->produccionService->list()
        ]);
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProduccionRequest $datos)
    {
        $registroInsertado = $this->produccionService->store($datos->validated());

        return response()->json([
            'success' => 'La producción se creó correctamente',
            'datosInsertados' => $registroInsertado
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProduccionRequest $request, Produccion $produccion)
{
    $produccion->update($request->validated());

    return response()->json([
        'success' => 'Producción actualizada correctamente',
        'data' => $produccion
    ], 200);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produccion $produccion)
{
    $produccion->delete();

    return response()->json([
        'message' => 'Producción eliminada correctamente'
    ], 200);
}
}