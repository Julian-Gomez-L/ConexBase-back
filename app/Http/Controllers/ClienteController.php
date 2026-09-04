<?php

namespace App\Http\Controllers;


use App\Services\ClientesService;
use App\Http\Requests\Cliente\StoreClienteRequest;
use App\Http\Requests\Cliente\UpdateClienteRequest;
use App\Models\Cliente;


class ClienteController extends Controller
{
    public function __construct(private ClientesService $clientesService)
    {}
     public function index()
     {
        return response()->json([
            'success' => 'Se listaron correctamente',
            'data'  => $this->clientesService->list()
        ]);
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteRequest $datos)
    {
        $registroInsertado = $this->clientesService->store($datos->validated());

        return response()->json([
            'success' => 'El cliente se creó correctamente',
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
    public function update(UpdateClienteRequest $request, Cliente $cliente)
{
    $cliente->update($request->validated());

    return response()->json([
        'success' => 'Cliente actualizado correctamente',
        'data' => $cliente
    ], 200);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
{
    $cliente->delete();

    return response()->json([
        'message' => 'Cliente eliminado correctamente'
    ], 200);
}
}