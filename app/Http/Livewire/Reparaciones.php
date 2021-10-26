<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reparacione;

class Reparaciones extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $referencia, $descripcion, $fechacita, $tiempoestimado, $fechaingreso, $fechafin, $fechaentrega, $codigodmsasesorservicio, $codigodmsoperadortecnico, $matriculatemporal, $user_id, $situacion_id, $vehiculo_id, $taller_id, $tipo_id;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.reparaciones.view', [
            'reparaciones' => Reparacione::latest()
						->orWhere('referencia', 'LIKE', $keyWord)
						->orWhere('descripcion', 'LIKE', $keyWord)
						->orWhere('fechacita', 'LIKE', $keyWord)
						->orWhere('tiempoestimado', 'LIKE', $keyWord)
						->orWhere('fechaingreso', 'LIKE', $keyWord)
						->orWhere('fechafin', 'LIKE', $keyWord)
						->orWhere('fechaentrega', 'LIKE', $keyWord)
						->orWhere('codigodmsasesorservicio', 'LIKE', $keyWord)
						->orWhere('codigodmsoperadortecnico', 'LIKE', $keyWord)
						->orWhere('matriculatemporal', 'LIKE', $keyWord)
						->orWhere('user_id', 'LIKE', $keyWord)
						->orWhere('situacion_id', 'LIKE', $keyWord)
						->orWhere('vehiculo_id', 'LIKE', $keyWord)
						->orWhere('taller_id', 'LIKE', $keyWord)
						->orWhere('tipo_id', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->referencia = null;
		$this->descripcion = null;
		$this->fechacita = null;
		$this->tiempoestimado = null;
		$this->fechaingreso = null;
		$this->fechafin = null;
		$this->fechaentrega = null;
		$this->codigodmsasesorservicio = null;
		$this->codigodmsoperadortecnico = null;
		$this->matriculatemporal = null;
		$this->user_id = null;
		$this->situacion_id = null;
		$this->vehiculo_id = null;
		$this->taller_id = null;
		$this->tipo_id = null;
    }

    public function store()
    {
        $this->validate([
		'descripcion' => 'required',
		'user_id' => 'required',
        ]);

        Reparacione::create([ 
			'referencia' => $this-> referencia,
			'descripcion' => $this-> descripcion,
			'fechacita' => $this-> fechacita,
			'tiempoestimado' => $this-> tiempoestimado,
			'fechaingreso' => $this-> fechaingreso,
			'fechafin' => $this-> fechafin,
			'fechaentrega' => $this-> fechaentrega,
			'codigodmsasesorservicio' => $this-> codigodmsasesorservicio,
			'codigodmsoperadortecnico' => $this-> codigodmsoperadortecnico,
			'matriculatemporal' => $this-> matriculatemporal,
			'user_id' => $this-> user_id,
			'situacion_id' => $this-> situacion_id,
			'vehiculo_id' => $this-> vehiculo_id,
			'taller_id' => $this-> taller_id,
			'tipo_id' => $this-> tipo_id
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Reparacione Successfully created.');
    }

    public function edit($id)
    {
        $record = Reparacione::findOrFail($id);

        $this->selected_id = $id; 
		$this->referencia = $record-> referencia;
		$this->descripcion = $record-> descripcion;
		$this->fechacita = $record-> fechacita;
		$this->tiempoestimado = $record-> tiempoestimado;
		$this->fechaingreso = $record-> fechaingreso;
		$this->fechafin = $record-> fechafin;
		$this->fechaentrega = $record-> fechaentrega;
		$this->codigodmsasesorservicio = $record-> codigodmsasesorservicio;
		$this->codigodmsoperadortecnico = $record-> codigodmsoperadortecnico;
		$this->matriculatemporal = $record-> matriculatemporal;
		$this->user_id = $record-> user_id;
		$this->situacion_id = $record-> situacion_id;
		$this->vehiculo_id = $record-> vehiculo_id;
		$this->taller_id = $record-> taller_id;
		$this->tipo_id = $record-> tipo_id;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'descripcion' => 'required',
		'user_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Reparacione::find($this->selected_id);
            $record->update([ 
			'referencia' => $this-> referencia,
			'descripcion' => $this-> descripcion,
			'fechacita' => $this-> fechacita,
			'tiempoestimado' => $this-> tiempoestimado,
			'fechaingreso' => $this-> fechaingreso,
			'fechafin' => $this-> fechafin,
			'fechaentrega' => $this-> fechaentrega,
			'codigodmsasesorservicio' => $this-> codigodmsasesorservicio,
			'codigodmsoperadortecnico' => $this-> codigodmsoperadortecnico,
			'matriculatemporal' => $this-> matriculatemporal,
			'user_id' => $this-> user_id,
			'situacion_id' => $this-> situacion_id,
			'vehiculo_id' => $this-> vehiculo_id,
			'taller_id' => $this-> taller_id,
			'tipo_id' => $this-> tipo_id
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Reparacione Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Reparacione::where('id', $id);
            $record->delete();
        }
    }
}
