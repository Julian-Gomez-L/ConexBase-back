<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UsuarioService;

class UsuarioController extends Controller
{
    public function __construct(private UsuarioService $usuarioService)
    {}

    public function index()
    {
        return response()->json([
            'success' => 'Se listaron correctamente',
            'data'    => $this->usuarioService->list()
        ]);
    }

    public function store(Request $request)
    {
        $registroInsertado = $this->usuarioService->store($request->all());

        return response()->json([
            'success'         => 'El usuario se creó correctamente',
            'datosInsertados' => $registroInsertado
        ]);
    }

    public function show(int $id)
    {
        return response()->json([
            'success' => 'Detalle del usuario',
            'data'    => $this->usuarioService->show($id)
        ]);
    }

    public function update(Request $request, int $id)
    {
        $usuarioActualizado = $this->usuarioService->update($request->all(), $id);

        return response()->json([
            'success' => 'Usuario actualizado correctamente',
            'data'    => $usuarioActualizado
        ], 200);
    }

    public function destroy(int $id)
    {
        $this->usuarioService->destroy($id);

        return response()->json([
            'message' => 'Usuario eliminado correctamente'
        ], 200);
    }
}