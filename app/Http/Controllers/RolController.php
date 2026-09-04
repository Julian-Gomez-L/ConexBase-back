<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RolService;
use App\Models\Rol;

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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Si usas un FormRequest, cambia 'Request' por 'StoreRolRequest' y usa $request->validated()
        $registroInsertado = $this->rolService->store($request->all());

        return response()->json([
            'success'         => 'El rol se creó correctamente',
            'datosInsertados' => $registroInsertado
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return response()->json([
            'success' => 'Detalle del rol obtenido correctamente',
            'data'    => $this->rolService->show($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $rolActualizado = $this->rolService->update($request->all(), $id);

        return response()->json([
            'success' => 'Rol actualizado correctamente',
            'data'    => $rolActualizado
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->rolService->destroy($id);

        return response()->json([
            'message' => 'Rol eliminado correctamente'
        ], 200);
    }
}