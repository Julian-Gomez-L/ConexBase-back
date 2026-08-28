<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = [
        'documento',
        'nombre',
        'apellido',
        'correo',
        'password',
        'rol_id',
        'estado'
    ];

    protected $hidden = [
        'password',
    ];

    // En belongsTo sí es buena idea dejar el ID explícito por seguridad
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }


    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

    public function producciones()
    {
        return $this->hasMany(Produccion::class);
    }

    public function trabajos_Tapicero()
    {
        return $this->hasMany(Trabajos_Tapicero::class);
    }

    public function historial_Pedidos()
    {
        return $this->hasMany(Historial_Pedido::class);
    }
}