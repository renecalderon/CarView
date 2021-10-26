<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propuesta extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'propuestas';

    protected $fillable = ['nombre_propuesta', 'vin', 'total', 'manodeobra', 'filename', 'path', 'hashfile', 'reparacion_id','estado_id','semaforo_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function archivos()
    {
        return $this->hasMany('App\Models\Archivo', 'propuesta_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function refacciones()
    {
        return $this->hasMany('App\Models\Refaccione', 'propuesta_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function reparacione()
    {
        return $this->hasOne('App\Models\Reparacione', 'id', 'reparacion_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function semaforo()
    {
        return $this->hasOne('App\Models\Semaforo', 'id', 'semaforo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function estado()
    {
        return $this->hasOne('App\Models\Estado', 'id', 'estado_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trabajos()
    {
        return $this->hasMany('App\Models\Trabajo', 'propuesta_id', 'id');
    }

}
