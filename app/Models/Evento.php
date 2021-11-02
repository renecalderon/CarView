<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'eventos';

    protected $fillable = ['comentario','categoria_id','user_id','reparacion_id'];

    public function categoria()
    {
        return $this->hasOne('App\Models\Categoria', 'id', 'categoria_id');
    }

    public function reparacion()
    {
        return $this->hasOne('App\Models\Reparacion', 'id', 'reparacion_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

}
