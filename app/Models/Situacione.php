<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Situacione extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'situaciones';

    protected $fillable = ['nombre','descripcion'];
	
}
