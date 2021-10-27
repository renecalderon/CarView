<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Situacion;

class Situaciones extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $descripcion;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.situaciones.view', [
            'situaciones' => Situacion::latest()
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('descripcion', 'LIKE', $keyWord)
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
		$this->descripcion = null;
    }

    public function store()
    {
        $this->validate([
		'nombre' => 'required',
		'descripcion' => 'required',
        ]);

        Situacion::create([
			'nombre' => $this-> nombre,
			'descripcion' => $this-> descripcion
        ]);

        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Situacion Successfully created.');
    }

    public function edit($id)
    {
        $record = Situacion::findOrFail($id);

        $this->selected_id = $id;
		$this->nombre = $record-> nombre;
		$this->descripcion = $record-> descripcion;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'nombre' => 'required',
		'descripcion' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Situacion::find($this->selected_id);
            $record->update([
			'nombre' => $this-> nombre,
			'descripcion' => $this-> descripcion
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Situacion Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Situacion::where('id', $id);
            $record->delete();
        }
    }
}
