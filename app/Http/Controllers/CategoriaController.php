<?php

namespace App\Http\Controllers;


use App\Services\CategoriasService;
use App\Http\Requests\Categoria\StoreCategoriaRequest;
use App\Http\Requests\Categoria\UpdateCategoriaRequest;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function __construct(private CategoriasService $categoriaService)
    {}
     public function index()
     {
        return response()->json([
            'success' => 'Se listaron correctamente',
            'data'  => $this->categoriaService->list()
        ]);
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriaRequest $datos)
    {
        $registroInsertado = $this->categoriaService->store($datos->validated());

        return response()->json([
            'success' => 'La categoría se creó correctamente',
            'datosInsertados' => $registroInsertado
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
{
    $categoria->update($request->validated());

    return response()->json([
        'success' => 'Categoría actualizada correctamente',
        'data' => $categoria
    ], 200);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
{
    $categoria->delete();

    return response()->json([
        'message' => 'Categoría eliminada correctamente'
    ], 200);
}
}