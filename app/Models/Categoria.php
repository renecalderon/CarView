<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'categorias';

    protected $fillable = ['categoria','icono','color','colorname'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eventos()
    {
        return $this->hasMany('App\Models\Evento', 'categoria_id', 'id');
    }
    
}
