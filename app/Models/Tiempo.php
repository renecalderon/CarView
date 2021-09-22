<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiempo extends Model
{
    use HasFactory;

    protected $table = 'tiempos';

    protected $fillable = ['estado', 'user_id', 'tecnico_id', 'reparacion_id'];
}
