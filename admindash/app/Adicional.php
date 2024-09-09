<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adicional extends Model
{
  protected $table = 'adicionales';
  protected $fillable = [
    'nombre', 'negocio' , 'precio' , 'moneda' , 'disponible',
  ];
}
