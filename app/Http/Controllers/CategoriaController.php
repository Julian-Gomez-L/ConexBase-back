<?php

namespace App\Http\Controllers;

use App\Services\MesaService;
use App\Http\Requests\Mesa\StoreMesaRequest;
use App\Http\Requests\Mesa\UpdateMesaRequest;

class CategoriaController extends Controller
{
    public function __construct(private CategoriaService $categoriaServicio)
    {
    }

    public function index()
    {
        return response()->json([
            "success" => "Se listaron correctamente",
            "data" => $this->categoriaServicio->list()
        ]);
    }

    public function store(StoreMesaRequest $datos)
    {
        $registroInsertado = $this->categoriaServicio->store(
            $datos->validated()
        );

        return response()->json([
            "success" => "La categoria se creó correctamente",
            "datosInsertado" => $registroInsertado
        ]);
    }

    public function show(string $id)
    {
        return response()->json([
            "data" => $this->categoriaServicio->show((int) $id)
        ]);
    }

    public function update(UpdateMesaRequest $datoActualizar, string $id)
    {
        $mesa = $this->mesaServicio->update(
            (int) $id,
            $datoActualizar->validated()
        );

        return response()->json([
            "success" => "La mesa se actualizó correctamente",
            "data" => $mesa
        ]);
    }

    public function destroy(string $id)
    {
        $mesa = $this->mesaServicio->destroy((int) $id);

        return response()->json([
            "success" => "La mesa se eliminó correctamente",
            "data" => $mesa
        ]);
    }
}