<?php

namespace App\Http\Controllers;


use App\Services\TrabajosTapicerosService;
use App\Http\Requests\Trabajos_Tapiceros\StoreTrabajosTapicerosRequest;
use App\Http\Requests\Trabajos_Tapiceros\UpdateTrabajosTapicerosRequest;
use App\Models\Trabajos_tapiceros;


class TrabajosTapicerosController extends Controller
{
    public function __construct(private TrabajosTapicerosService $trabajos_tapicerosService)
    {}
     public function index()
     {
        return response()->json([
            'success' => 'Se listaron correctamente',
            'data'  => $this->trabajos_tapicerosService->list()
        ]);
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrabajosTapicerosRequest $datos)
    {
        $registroInsertado = $this->trabajos_tapicerosService->store($datos->validated());

        return response()->json([
            'success' => 'Los trabajos de tapiceros se crearon correctamente',
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
    public function update(UpdateTrabajosTapicerosRequest $request, Trabajos_tapiceros $trabajos_tapiceros)
{
    $trabajos_tapiceros->update($request->validated());

    return response()->json([
        'success' => 'Trabajos de tapiceros actualizados correctamente',
        'data' => $trabajos_tapiceros
    ], 200);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trabajos_tapiceros $trabajos_tapiceros)
{
    $trabajos_tapiceros->delete();

    return response()->json([
        'message' => 'Trabajos de tapiceros eliminados correctamente'
    ], 200);
}
}