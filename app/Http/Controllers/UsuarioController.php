<?php

namespace App\Http\Controllers;

use App\Services\UsuarioService;
use App\Http\Requests\Usuario\StoreUsuarioRequest;
use App\Http\Requests\Usuario\UpdateUsuarioRequest;
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
    public function store(StoreUsuarioRequest $datos)
    {
        $registroInsertado = $this->usuarioService->store($datos->validated());

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
    public function update(UpdateUsuarioRequest $request, Usuario $usuario)
    {
        $usuario->update($request->validated());

        return response()->json([
            'success' => 'Usuario actualizado correctamente',
            'data'    => $usuario
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();

        return response()->json([
            'message' => 'Usuario eliminado correctamente'
        ], 200);
    }
}