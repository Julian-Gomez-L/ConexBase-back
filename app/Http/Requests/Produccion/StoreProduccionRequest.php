<?php

namespace App\Http\Requests\Produccion;


use Illuminate\Foundation\Http\FormRequest;

class StoreProduccionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['nullable', 'date'],
            'estado' => ['required', 'string'],
            'observaciones' => ['nullable', 'string'],
            'id_pedido' => ['required', 'integer', 'exists:pedidos,id'],
            'id_producto' => ['required', 'integer', 'exists:productos,id'],
            'id_usuario' => ['required', 'integer', 'exists:usuarios,id'],
            'id_trabajos_tapiceros' => ['nullable', 'integer', 'exists:trabajos_tapiceros,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'fecha_fin.date' => 'La fecha de fin debe ser una fecha válida.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.string' => 'El estado debe ser una cadena de texto.',
            'observaciones.string' => 'Las observaciones deben ser una cadena de texto.',
            'id_pedido.required' => 'El ID del pedido es obligatorio.',
            'id_pedido.integer' => 'El ID del pedido debe ser un número entero.',
            'id_pedido.exists' => 'El ID del pedido no existe en la base de datos.',
            'id_producto.required' => 'El ID del producto es obligatorio.',
            'id_producto.integer' => 'El ID del producto debe ser un número entero.',
            'id_producto.exists' => 'El ID del producto no existe en la base de datos.',
            'id_usuario.required' => 'El ID del usuario es obligatorio.',
            'id_usuario.integer' => 'El ID del usuario debe ser un número entero.',
            'id_usuario.exists' => 'El ID del usuario no existe en la base de datos.',
            'id_trabajos_tapiceros.integer' => 'El ID de los trabajos tapiceros debe ser un número entero.',
            'id_trabajos_tapiceros.exists' => 'El ID de los trabajos tapiceros no existe en la base de datos.',
        ];
    }
}