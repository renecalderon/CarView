<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiempo extends Model
{
    use HasFactory;

    protected $table = 'tiempos';

    protected $fillable = ['estado', 'inicio', 'fin', 'user_id', 'reparacion_id'];
}
