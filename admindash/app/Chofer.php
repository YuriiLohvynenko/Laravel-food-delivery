<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chofer extends Model
{
   public $table = 'choferes';
  protected $fillable = [
    'usuario', 'negocio' , 'estatus' , 'descripcion' ,
  ];
}
