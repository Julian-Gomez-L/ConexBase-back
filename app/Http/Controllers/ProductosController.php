<?php

namespace App\Http\Controllers;

use App\Services\MesaService;
use App\Http\Requests\Mesa\StoreMesaRequest;
use App\Http\Requests\Mesa\UpdateMesaRequest;

class ProductosController extends Controller
{
    public function __construct(private ProductosService $productosServicio)
    {
    }

    public function index()
    {
        return response()->json([
            "success" => "Se listaron correctamente",
            "data" => $this->productosServicio->list()
        ]);
    }

    public function store(StoreMesaRequest $datos)
    {
        $registroInsertado = $this->productosServicio->store(
            $datos->validated()
        );

        return response()->json([
            "success" => "El producto se creó correctamente",
            "datosInsertado" => $registroInsertado
        ]);
    }

    public function show(string $id)
    {
        return response()->json([
            "data" => $this->productosServicio->show((int) $id)
        ]);
    }

    public function update(UpdateMesaRequest $datoActualizar, string $id)
    {
        $mesa = $this->productosServicio->update(
            (int) $id,
            $datoActualizar->validated()
        );

        return response()->json([
            "success" => "El producto se actualizó correctamente",
            "data" => $mesa
        ]);
    }

    public function destroy(string $id)
    {
        $mesa = $this->productosServicio->destroy((int) $id);

        return response()->json([
            "success" => "El producto se eliminó correctamente",
            "data" => $mesa
        ]);
    }
}