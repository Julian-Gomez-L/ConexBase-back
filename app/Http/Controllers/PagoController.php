<?php

namespace App\Http\Controllers;

use App\Services\PagosService;
use App\Http\Requests\Pagos\StorePagoRequest;
use App\Http\Requests\Pagos\UpdatePagoRequest;

class PagoController extends Controller
{
    public function __construct(
        private PagosService $pagosService
    ) {}

    public function index()
    {
        return response()->json([
            'success' => 'Los pagos se listaron correctamente',
            'data' => $this->pagosService->list()
        ]);
    }

    public function store(StorePagoRequest $request)
    {
        return response()->json([
            'success' => 'El pago se creó correctamente',
            'data' => $this->pagosService->store($request->validated())
        ]);
    }

    public function show(int $id)
    {
        return response()->json([
            'success' => 'El pago se encontró correctamente',
            'data' => $this->pagosService->show($id)
        ]);
    }

    public function update(UpdatePagoRequest $request, int $id)
    {
        return response()->json([
            'success' => 'El pago se actualizó correctamente',
            'data' => $this->pagosService->update(
                $request->validated(),
                $id
            )
        ]);
    }

    public function destroy(int $id)
    {
        $this->pagosService->destroy($id);

        return response()->json([
            'success' => 'El pago se eliminó correctamente'
        ]);
    }
}