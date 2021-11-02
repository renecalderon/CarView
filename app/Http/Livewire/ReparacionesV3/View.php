<?php

namespace App\Http\Livewire\Reparaciones;

use App\Models\Estado;
use App\Models\Marca;
use App\Models\Reparacion;
use App\Models\Tipo;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class View extends Component
{
    use WithPagination;
	protected $paginationTheme = 'bootstrap';

    public $keyWord;

    public function render()
    {

        $keyWord = '%'.$this->keyWord .'%';
        return view('livewire.reparaciones.view', [
            'reparaciones' => Reparacion::latest()->orderBy('updated_at', 'DESC')
                ->orWhere('referencia', 'LIKE', $keyWord)
                ->orWhere('descripcion', 'LIKE', $keyWord)
                ->orWhere('fechacita', 'LIKE', $keyWord)
                ->orWhere('fechaingreso', 'LIKE', $keyWord)
                ->orWhereHas('vehiculo', function ( $query ) use ( $keyWord ){
                    $query->where("modelo", "LIKE", "%" . $keyWord . "%")
                        ->orWhere("vin", "LIKE", "%" . $keyWord . "%")
                        ->orWhere("matricula", "LIKE", "%" . $keyWord . "%")
                    ->orWhereHas('cliente', function ( $query ) use ( $keyWord ){
                        $query->where("nombre", "LIKE", "%" . $keyWord . "%")
                            ->orWhere("celular", "LIKE", "%" . $keyWord . "%")
                            ->orWhere("apellidopaterno", "LIKE", "%" . $keyWord . "%")
                            ->orWhere("apellidomaterno", "LIKE", "%" . $keyWord . "%")
                            ->orWhereRaw("concat(nombre, ' ', apellidopaterno, ' ', apellidomaterno) like '%$keyWord%' ");
                    });
                })
                ->Paginate(10),
        ]);
    }
}
