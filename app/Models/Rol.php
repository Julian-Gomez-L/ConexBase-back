<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado'
    ];

    /**
     * Relaciones
     */
    
    // Un rol tiene muchos usuarios (hasMany)
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'rol_id');
    }
}