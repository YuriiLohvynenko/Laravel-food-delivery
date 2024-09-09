<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedidocomplemento extends Model
{
  protected $fillable = [
    'pedido', 'pedidodetalle', 'nombre', 'precio', 
  ];
}
