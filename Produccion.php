<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class produccion extends Model
{
    use HasFactory;

    protected $table = 'produccion';

    protected $fillable = [
        'id',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'observaciones',
        'id_pedido',
        'id_producto',
        'id_usuario',
        'id_trabajos_tapiceros',
    ];

        public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

        public function trabajos_Tapicerio()
    {
        return $this->hasMany(trabajos_Tapiceros::class, 'id_trabajos_tapiceros');
    }
}