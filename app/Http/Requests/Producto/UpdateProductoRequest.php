<?php

namespace App\Http\Requests\Producto;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['sometimes', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'precio' => ['sometimes', 'numeric', 'min:0'],
            'stock' => ['sometimes', 'integer', 'min:0'],
            'id_categoria' => ['sometimes', 'integer', 'exists:categorias,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
            'precio.numeric' => 'El precio debe ser un valor numérico.',
            'precio.min' => 'El precio no puede ser negativo.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock no puede ser negativo.',
            'id_categoria.integer' => 'El ID de la categoría debe ser un número entero.',
            'id_categoria.exists' => 'La categoría no existe en la base de datos.',
        ];
    }
}