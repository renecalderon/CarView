<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'marcas';

    protected $fillable = ['prefijo','marca'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vehiculos()
    {
        return $this->hasMany('App\Models\Vehiculo', 'marca_id', 'id');
    }
    
}
