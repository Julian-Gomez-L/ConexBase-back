<?php

namespace App\Http\Controllers;

use App\Services\DetallePedidoService;
use App\Http\Requests\DetallePedidos\StoreDetallePedidoRequest;
use App\Http\Requests\DetallePedidos\UpdateDetallePedidoRequest;

class DetallePedidoController extends Controller
{
    public function __construct(
        private DetallePedidoService $detallePedidoService
    ) {}

    public function index()
    {
        return response()->json([
            'success' => 'Los detalles de pedido se listaron correctamente',
            'data' => $this->detallePedidoService->list()
        ]);
    }

    public function store(StoreDetallePedidoRequest $request)
    {
        return response()->json([
            'success' => 'El detalle de pedido se creó correctamente',
            'data' => $this->detallePedidoService->store(
                $request->validated()
            )
        ]);
    }

    public function show(int $id)
    {
        return response()->json([
            'success' => 'El detalle de pedido se encontró correctamente',
            'data' => $this->detallePedidoService->show($id)
        ]);
    }

    public function update(
        UpdateDetallePedidoRequest $request,
        int $id
    ) {
        return response()->json([
            'success' => 'El detalle de pedido se actualizó correctamente',
            'data' => $this->detallePedidoService->update(
                $request->validated(),
                $id
            )
        ]);
    }

    public function destroy(int $id)
    {
        $this->detallePedidoService->destroy($id);

        return response()->json([
            'success' => 'El detalle de pedido se eliminó correctamente'
        ]);
    }
}