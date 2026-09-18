<?php

namespace App\Http\Controllers;

use App\Services\ProductoService;
use App\Http\Requests\Producto\StoreProductoRequest;
use App\Http\Requests\Producto\UpdateProductoRequest;
use App\Models\Producto;

/**
 * @group Productos
 *
 * Gestión de los productos del sistema.
 */
class ProductoController extends Controller
{
    public function __construct(private ProductoService $productoService)
    {}

    public function index()
    {
        return response()->json([
            'success' => 'Se listaron correctamente',
            'data'  => $this->productoService->list()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductoRequest $datos)
    {
        $registroInsertado = $this->productoService->store($datos->validated());

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
    public function update(UpdateProductoRequest $request, int $id)
    {
        return response()->json([
            'success' => 'El producto se actualizó correctamente',
            'data' => $this->productoService->update(
                $request->validated(),
                $id
            )
        ]);
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