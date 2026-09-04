<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UsuarioService;
use App\Models\Usuario;

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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $registroInsertado = $this->usuarioService->store($request->all());

        return response()->json([
            'success'         => 'El usuario se creó correctamente',
            'datosInsertados' => $registroInsertado
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return response()->json([
            'success' => 'Detalle del usuario obtenido correctamente',
            'data'    => $this->usuarioService->show($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $usuarioActualizado = $this->usuarioService->update($request->all(), $id);

        return response()->json([
            'success' => 'Usuario actualizado correctamente',
            'data'    => $usuarioActualizado
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->usuarioService->destroy($id);

        return response()->json([
            'message' => 'Usuario eliminado correctamente'
        ], 200);
    }
}