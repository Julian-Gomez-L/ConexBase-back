<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Historial_pedidos extends Model
{
    use HasFactory;

    protected $table = 'historial_pedidos';

    protected $fillable = [
        'id',
        'fecha',
        'estado_anterior',
        'estado_nuevo',
        'observacion',
        'id_cliente',
        'id_usuario',
        'id_pedido',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido');
    }
}