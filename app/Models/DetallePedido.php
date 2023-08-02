<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    use HasFactory;

    protected $table = 'detalle_pedidos';
    protected $fillable = [
        'idPedido', 'idProducto', 'cantidad'
    ];


    /*  public function detalle_pedido(){
        return $this->hasOne('App\Models\Pedido', 'id', 'idPedido');
    }
 */
    public function product(){
        return $this->hasOne('App\Models\Producto', 'id', 'idProducto');
    }
}
