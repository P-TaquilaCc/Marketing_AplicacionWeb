<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'productos';
    protected $fillable = [
        'idNegocio','idCategoria', 'nombre', 'descripcion',
        'precio', 'imagen', 'estado'
    ];

    public function category(){
        return $this->hasOne('App\Models\CategoriaProducto', 'id', 'idCategoria');
    }

    public function product(){
        return $this->hasMany('App\Models\DetallePedido', 'idProducto', 'id');
    }
}
