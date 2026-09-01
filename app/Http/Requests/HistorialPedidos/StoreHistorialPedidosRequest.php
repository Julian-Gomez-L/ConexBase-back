<?php

namespace App\Http\Requests\HistorialPedidos;


use Illuminate\Foundation\Http\FormRequest;

class StoreHistorialPedidosRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_pedido' => ['required', 'integer', 'exists:pedidos,id'],
            'estado' => ['required', 'string'],
            'observaciones' => ['nullable', 'string'],
            'fecha' => ['required', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'id_pedido.required' => 'El ID del pedido es obligatorio.',
            'id_pedido.integer' => 'El ID del pedido debe ser un número entero.',
            'id_pedido.exists' => 'El ID del pedido no existe en la base de datos.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.string' => 'El estado debe ser una cadena de texto.',
            'observaciones.string' => 'Las observaciones deben ser una cadena de texto.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha debe ser una fecha válida.',
        ];
    }
}