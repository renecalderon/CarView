<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reparacion extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'reparaciones';

    protected $fillable = ['referencia','descripcion','fechacita','tiempoestimado','fechaingreso','fechafin','fechaentrega','codigodmsasesorservicio','codigodmsoperadortecnico','matriculatemporal','user_id','situacion_id','vehiculo_id','taller_id','tipo_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comentarios()
    {
        return $this->hasMany('App\Models\Comentario', 'reparacion_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eventos()
    {
        return $this->hasMany('App\Models\Evento', 'reparacion_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function propuestas()
    {
        return $this->hasMany('App\Models\Propuesta', 'reparacion_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function refacciones()
    {
        return $this->hasMany('App\Models\Refaccione', 'reparacion_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function situacion()
    {
        return $this->hasOne('App\Models\Situacion', 'id', 'situacion_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function taller()
    {
        return $this->hasOne('App\Models\Taller', 'id', 'taller_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tiempos()
    {
        return $this->hasMany('App\Models\Tiempo', 'reparacion_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipo()
    {
        return $this->hasOne('App\Models\Tipo', 'id', 'tipo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function vehiculo()
    {
        return $this->hasOne('App\Models\Vehiculo', 'id', 'vehiculo_id');
    }

}
