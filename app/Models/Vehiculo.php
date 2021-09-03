<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $table = 'vehiculos';

    protected $fillable = ['vin', 'matricula', 'familia', 'modelo', 'color', 'anio', 'marca_id', 'cliente_id'];

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente');
    }
}
