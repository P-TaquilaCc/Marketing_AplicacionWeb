<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Negocio extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idCategoria',
        'idPlan',
        'tipo',
        'RUC',
        'razonSocial',
        'DNI',
        'representanteLegal',
        'nombre',
        'fotoPerfil',
        'telefono',
        'direccion',
        'correo',
        'password',
        'imagen',
        'hora_inicio',
        'hora_fin',
        'latitud',
        'longitud',
        'estado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function negocio(){
        return $this->hasMany('App\Models\Pedido', 'idNegocio', 'id');
    }

    public function category(){
        return $this->hasOne('App\Models\CategoriaNegocio', 'id', 'idCategoria');
    }

    public function plan(){
        return $this->hasOne('App\Models\Plan', 'id', 'idPlan');
    }

}
