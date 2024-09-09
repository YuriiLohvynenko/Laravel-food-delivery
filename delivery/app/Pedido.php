<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
  protected $fillable = [
    'user', 'negocio' , 'metodo' , 'zona' , 'urbanizacion', 'calle', 'casa', 'referencia',
    'latitud', 'longitud', 'subtotal', 'costodelivery', 'total', 'tasadecambio',
    'comprobante', 'instrucciones', 'estatus',
  ];
}
