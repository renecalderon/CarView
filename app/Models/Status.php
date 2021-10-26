<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'statuses';

    protected $fillable = ['nombre','descripcion','color','colorname'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function propuestas()
    {
        return $this->hasMany('App\Models\Propuesta', 'status_id', 'id');
    }
    
}
