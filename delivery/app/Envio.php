<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Envio extends Model
{
  protected $fillable = [
    'chofer', 'pedido' ,'cur_lat','cur_lng'
  ];
}
