<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedidodetalle extends Model
{
  protected $fillable = [
    'pedido', 'menu', 'cantidad', 'precio', 
  ];
}
