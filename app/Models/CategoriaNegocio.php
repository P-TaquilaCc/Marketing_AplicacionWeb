<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaNegocio extends Model
{
    use HasFactory;
    protected $table = 'categoria_negocios';
    protected $fillable = [
        'nombre', 'imagen', 'estado'
    ];

    public function category(){
        return $this->hasMany('App\Models\Negocio', 'idCategoria', 'id');
    }

}
