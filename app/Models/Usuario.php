<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'documento',
        'nombre',
        'apellido',
        'correo',
        'password',
        'rol_id',
        'estado'
    ];

    // Ocultar la contraseña al hacer consultas para mayor seguridad
    protected $hidden = [
        'password',
    ];

    /**
     * Relaciones
     */

    // Un usuario pertenece a un rol (belongsTo)
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    // Un usuario puede registrar muchos pedidos (hasMany)
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'usuario_id');
    }

    // Un usuario puede registrar muchos pagos (hasMany)
    public function pagos()
    {
        return $this->hasMany(Pago::class, 'usuario_id');
    }

    // Un usuario puede estar encargado de muchas producciones (hasMany)
    public function producciones()
    {
        return $this->hasMany(Produccion::class, 'usuario_id');
    }

    // Un usuario puede realizar muchos trabajos de tapicería (hasMany)
    public function trabajosTapicero()
    {
        return $this->hasMany(TrabajoTapicero::class, 'usuario_id');
    }

    // Un usuario puede registrar muchos historiales de pedidos (hasMany)
    public function historialPedidos()
    {
        return $this->hasMany(HistorialPedido::class, 'usuario_id');
    }
}