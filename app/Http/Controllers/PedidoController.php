<?php

namespace App\Http\Controllers;

use App\Services\PedidosService;
use App\Http\Requests\Pedidos\StorePedidoRequest;
use App\Http\Requests\Pedidos\UpdatePedidoRequest;

class PedidoController extends Controller
{
    public function __construct(
        private PedidosService $pedidosService
    ) {
    }

    public function index()
    {
        return response()->json([
            'success' => 'Se listaron correctamente',
            'data' => $this->pedidosService->list()
        ]);
    }

    public function store(StorePedidoRequest $request)
    {
        return response()->json([
            'success' => 'El pedido se creó correctamente',
            'data' => $this->pedidosService->store($request->validated())
        ]);
    }

    public function show(int $id)
    {
        return response()->json([
            'success' => 'El pedido se encontró correctamente',
            'data' => $this->pedidosService->show($id)
        ]);
    }

    public function update(UpdatePedidoRequest $request, int $id)
    {
        return response()->json([
            'success' => 'El pedido se actualizó correctamente',
            'data' => $this->pedidosService->update(
                $request->validated(),
                $id
            )
        ]);
    }

    public function destroy(int $id)
    {
        $this->pedidosService->destroy($id);

        return response()->json([
            'success' => 'El pedido se eliminó correctamente'
        ]);
    }
}