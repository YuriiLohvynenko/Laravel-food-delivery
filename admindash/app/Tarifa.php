<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
  protected $fillable = [
    'negocio', 'zona' , 'precio' , 'moneda' , 'estatus',
  ];
}
