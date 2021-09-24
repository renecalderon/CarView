<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Propuesta;

class Propuestas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $reparacion_id, $status_id, $semaforo_id;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.propuestas.view', [
            'propuestas' => Propuesta::latest()
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('reparacion_id', 'LIKE', $keyWord)
						->orWhere('status_id', 'LIKE', $keyWord)
						->orWhere('semaforo_id', 'LIKE', $keyWord)
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
		$this->nombre = null;
		$this->reparacion_id = null;
		$this->status_id = null;
		$this->semaforo_id = null;
    }

    public function store()
    {
        $this->validate([
		'nombre' => 'required',
		'reparacion_id' => 'required',
		'status_id' => 'required',
		'semaforo_id' => 'required',
        ]);

        Propuesta::create([ 
			'nombre' => $this-> nombre,
			'reparacion_id' => $this-> reparacion_id,
			'status_id' => $this-> status_id,
			'semaforo_id' => $this-> semaforo_id
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Propuesta Successfully created.');
    }

    public function edit($id)
    {
        $record = Propuesta::findOrFail($id);

        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
		$this->reparacion_id = $record-> reparacion_id;
		$this->status_id = $record-> status_id;
		$this->semaforo_id = $record-> semaforo_id;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'nombre' => 'required',
		'reparacion_id' => 'required',
		'status_id' => 'required',
		'semaforo_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Propuesta::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre,
			'reparacion_id' => $this-> reparacion_id,
			'status_id' => $this-> status_id,
			'semaforo_id' => $this-> semaforo_id
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Propuesta Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Propuesta::where('id', $id);
            $record->delete();
        }
    }
}
