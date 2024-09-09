<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
  protected $fillable = [
    'nombre', 'negocio' , 'precio' , 'moneda' , 'descripcion' , 'votacion', 'promocion', 'foto', 'disponible'
  ];
}
