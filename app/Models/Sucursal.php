<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'sucursales';

    protected $fillable = ['nombre','direccion','pagina','telefono','empresa_id'];

    public function empresa()
    {
        return $this->hasOne('App\Models\Empresa', 'id', 'empresa_id');
    }
}
