<?php

namespace App\Http\Controllers;


use App\Services\HistorialPedidosService;
use App\Http\Requests\Historial_Pedidos\StoreHistorialPedidosRequest;
use App\Http\Requests\Historial_Pedidos\UpdateHistorialPedidosRequest;
use App\Models\Historial_Pedidos;

class HistorialPedidosController extends Controller
{
    public function __construct(private HistorialPedidosService $historialPedidosService)
    {}
     public function index()
     {
        return response()->json([
            'success' => 'Se listaron correctamente',
            'data'  => $this->historialPedidosService->list()
        ]);
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHistorialPedidosRequest $datos)
    {
        $registroInsertado = $this->historialPedidosService->store($datos->validated());

        return response()->json([
            'success' => 'El historial de pedidos se creó correctamente',
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
    public function update(UpdateHistorialPedidosRequest $request, Historial_Pedidos $historialPedidos)
{
    $historialPedidos->update($request->validated());

    return response()->json([
        'success' => 'Historial de pedidos actualizado correctamente',
        'data' => $historialPedidos
    ], 200);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Historial_Pedidos $historialPedidos)
{
    $historialPedidos->delete();

    return response()->json([
        'message' => 'Historial de pedidos eliminado correctamente'
    ], 200);
}
}