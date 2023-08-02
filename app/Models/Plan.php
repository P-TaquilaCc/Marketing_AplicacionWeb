<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'plans';
    protected $fillable = [
        'nombre','precioMensual', 'porcentaje'
    ];

    public function plan(){
        return $this->hasMany('App\Models\Negocio', 'idPlan', 'id');
    }


}
