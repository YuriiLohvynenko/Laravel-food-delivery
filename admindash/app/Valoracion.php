<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
  protected $table = 'valoraciones';
  protected $fillable = [
    'pedido', 'usuario' , 'rating' , 'comentario', 'tipo',
  ];
}
