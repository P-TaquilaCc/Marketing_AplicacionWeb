<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';
    protected $fillable = [
        'idCliente', 'idNegocio', 'direccion',
        'fecha', 'estado'
    ];


    public function client(){
        return $this->hasOne('App\Models\User', 'id', 'idCliente');
    }

    public function negocio(){
        return $this->hasOne('App\Models\Negocio', 'id', 'idNegocio');
    }

   /*  public function detalle_pedido(){
        return $this->hasMany('App\Models\DetallePedido', 'idPedido', 'id');
    } */
}
