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

}