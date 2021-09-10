<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reparacion extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'reparaciones';

    protected $fillable = ['referencia','descripcion','fechacita','tiempoestimado','fechaingreso','fechafin','fechaentrega','codigodmsasesorservicio','codigodmsoperadortecnico','matriculatemporal','user_id','estado_id','vehiculo_id','taller_id','tipo_id'];

    public function tiempos()
    {
        return $this->hasMany('App\Models\Tiempo', 'reparacion_id', 'id');
    }

    public function comentarios()
    {
        return $this->hasMany('App\Models\Comentario', 'reparacion_id', 'id');
    }

    public function estado()
    {
        return $this->hasOne('App\Models\Estado', 'id', 'estado_id');
    }

    public function propuestas()
    {
        return $this->hasMany('App\Models\Propuesta', 'reparacion_id', 'id');
    }

    public function taller()
    {
        return $this->hasOne('App\Models\Taller', 'id', 'taller_id');
    }

    public function tipo()
    {
        return $this->hasOne('App\Models\Tipo', 'id', 'tipo_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function vehiculo()
    {
        return $this->hasOne('App\Models\Vehiculo', 'id', 'vehiculo_id');
    }

}
