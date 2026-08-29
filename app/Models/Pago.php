<?php   

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pago extends Model
{
    use HasFactory;

    protected $table =  'pagos';

    protected $fillable = [
        'pedido_id',
        'usuario_id',
        'monto',
        'metodo',
        'fecha_pago',
        'comprobante',
    ];

    protected $casts =[
        'fecha_pago' => 'datetime' 
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'cliente_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }
}

