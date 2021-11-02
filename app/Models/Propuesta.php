<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propuesta extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'propuestas';

    protected $fillable = [
        'propuesta_numero',
        'propuesta_fecha',
        'propuesta_tipo',
        'propuesta_referencia',
        'propuesta_asesor',
        'propuesta_descripcion',
        'propuesta_matricula',
        'propuesta_vin',
        'propuesta_modelo',
        'propuesta_kilometros',
        'propuesta_total_manodeobra',
        'propuesta_total_refacciones',
        'propuesta_base',
        'propuesta_iva',
        'propuesta_total',
        'propuesta_filename',
        'propuesta_path',
        'propuesta_hashfile',
        'reparacion_id',
        'estado_id',
        'semaforo_id'
    ];

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
