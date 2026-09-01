<?php

namespace App\Http\Requests\Produccion;


use Illuminate\Foundation\Http\FormRequest;


class UpdateProduccionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fecha_inicio' => ['sometimes', 'date'],
            'fecha_fin' => ['nullable', 'date'],
            'estado' => ['sometimes', 'string'],
            'observaciones' => ['nullable', 'string'],
            'id_pedido' => ['sometimes', 'integer', 'exists:pedidos,id'],
            'id_producto' => ['sometimes', 'integer', 'exists:productos,id'],
            'id_usuario' => ['sometimes', 'integer', 'exists:usuarios,id'],
            'id_trabajos_tapiceros' => ['nullable', 'integer', 'exists:trabajos_tapiceros,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'fecha_fin.date' => 'La fecha de fin debe ser una fecha válida.',
            'estado.string' => 'El estado debe ser una cadena de texto.',
            'observaciones.string' => 'Las observaciones deben ser una cadena de texto.',
            'id_pedido.integer' => 'El ID del pedido debe ser un número entero.',
            'id_pedido.exists' => 'El ID del pedido no existe en la base de datos.',
            'id_producto.integer' => 'El ID del producto debe ser un número entero.',
            'id_producto.exists' => 'El ID del producto no existe en la base de datos.',
            'id_usuario.integer' => 'El ID del usuario debe ser un número entero.',
            'id_usuario.exists' => 'El ID del usuario no existe en la base de datos.',
            'id_trabajos_tapiceros.integer' => 'El ID de los trabajos tapiceros debe ser un número entero.',
            'id_trabajos_tapiceros.exists' => 'El ID de los trabajos tapiceros no existe en la base de datos.',
        ];
    }
}