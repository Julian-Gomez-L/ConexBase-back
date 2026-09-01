<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrabajosTapiceros extends Model
{
    use HasFactory;

    protected $table = 'trabajos_tapicero';

    protected $fillable = [
        'id',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'observaciones',
        'descripcion',
        'id_produccion',
        'id_usuario',
    ];

    public function produccion()
    {
        return $this->belongsTo(Produccion::class, 'id_produccion');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}