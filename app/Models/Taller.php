<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'talleres';

    protected $fillable = ['numero','descripcion'];

    public function reparaciones()
    {
        return $this->hasMany('App\Models\Reparacion', 'taller_id', 'id');
    }

}
