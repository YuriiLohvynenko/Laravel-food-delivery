<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
  protected $fillable = [
    'user','nombre','telefono',
    'direccion' , 'sector', 'latitud' , 'longitud' , 'tasadecambio',
    'lunesa', 'lunesc', 'martesa', 'martesc', 'miercolesa', 'miercolesc',
    'juevesa', 'juevesc', 'viernesa', 'viernesc', 'sabadoa', 'sabadoc',
    'domingoa', 'domingoc', 'categoria', 'logo', 'foto','estatus',
  ];
}
