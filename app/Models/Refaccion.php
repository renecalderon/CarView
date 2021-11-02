<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refaccion extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'refacciones';

    protected $fillable = ['vin','total','filename','path','hashfile','reparacion_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function reparacion()
    {
        return $this->hasOne('App\Models\Reparacion', 'id', 'reparacion_id');
    }

}
