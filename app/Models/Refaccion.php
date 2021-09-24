<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refaccion extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'refacciones';

    protected $fillable = ['parte','descripcion','cantidad','precio','propuesta_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function propuesta()
    {
        return $this->hasOne('App\Models\Propuesta', 'id', 'propuesta_id');
    }

}
