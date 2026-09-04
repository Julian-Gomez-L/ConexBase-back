<?php

namespace App\Http\Controllers;


use App\Services\ProductosService;
use App\Http\Requests\Producto\StoreProductoRequest;
use App\Http\Requests\Producto\UpdateProductoRequest;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function __construct(private ProductosService $productosService)
    {}
     public function index()
     {
        return response()->json([
            'success' => 'Se listaron correctamente',
            'data'  => $this->productosService->list()
        ]);
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductoRequest $datos)
    {
        $registroInsertado = $this->productosService->store($datos->validated());

        return response()->json([
            'success' => 'El producto se creó correctamente',
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
    public function update(UpdateProductoRequest $request, Producto $producto)
{
    $producto->update($request->validated());

    return response()->json([
        'success' => 'Producto actualizado correctamente',
        'data' => $producto
    ], 200);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
{
    $producto->delete();

    return response()->json([
        'message' => 'Producto eliminado correctamente'
    ], 200);
}
}