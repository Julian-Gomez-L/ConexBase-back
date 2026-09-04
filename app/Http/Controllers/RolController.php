<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RolService;

class RolController extends Controller
{
    public function __construct(private RolService $rolService)
    {}

    public function index()
    {
        return response()->json([
            'success' => 'Se listaron correctamente',
            'data'    => $this->rolService->list()
        ]);
    }

    public function store(Request $request)
    {
        $registroInsertado = $this->rolService->store($request->all());

        return response()->json([
            'success'         => 'El rol se creó correctamente',
            'datosInsertados' => $registroInsertado
        ]);
    }

    public function show(int $id)
    {
        return response()->json([
            'success' => 'Detalle del rol',
            'data'    => $this->rolService->show($id)
        ]);
    }

    public function update(Request $request, int $id)
    {
        $rolActualizado = $this->rolService->update($request->all(), $id);

        return response()->json([
            'success' => 'Rol actualizado correctamente',
            'data'    => $rolActualizado
        ], 200);
    }

    public function destroy(int $id)
    {
        $this->rolService->destroy($id);

        return response()->json([
            'message' => 'Rol eliminado correctamente'
        ], 200);
    }
}