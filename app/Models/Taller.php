<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'talleres';

    protected $fillable = ['numero','descripcion','sucursal_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reparaciones()
    {
        return $this->hasMany('App\Models\Reparacion', 'taller_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sucursal()
    {
        return $this->hasOne('App\Models\Sucursal', 'id', 'sucursal_id');
    }

}
