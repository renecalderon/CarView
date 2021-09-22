<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'tipos';

    protected $fillable = ['nombre','descripcion'];
	
    public function reparaciones()
    {
        return $this->hasMany('App\Models\Reparacione', 'tipo_id', 'id');
    }

}
