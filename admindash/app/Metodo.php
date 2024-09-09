<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metodo extends Model
{
  protected $fillable = [
    'negocio', 'bs' , 'usd' , 'zelle' , 'otro' ,
  ];
}
