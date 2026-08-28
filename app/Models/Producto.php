<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'categoria_id',
        'estado',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'estado' => 'boolean',
    ];

    public function categoria()

    {
        return $this->belongsTo(Categoria::class);
    }

    public function pedido()

    {
        return $this->hasMany(pedido::class);
    }

    public function producciones()

    {
        return $this->hasMany(producciones::class);
    }
}