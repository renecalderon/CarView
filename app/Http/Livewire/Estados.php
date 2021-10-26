<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Estado;

class Estados extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $descripcion, $color, $colorname;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.estados.view', [
            'estados' => Estado::latest()
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('descripcion', 'LIKE', $keyWord)
						->orWhere('color', 'LIKE', $keyWord)
						->orWhere('colorname', 'LIKE', $keyWord)
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
		$this->color = null;
		$this->colorname = null;
    }

    public function store()
    {
        $this->validate([
		'nombre' => 'required',
		'descripcion' => 'required',
		'color' => 'required',
		'colorname' => 'required',
        ]);

        Estado::create([ 
			'nombre' => $this-> nombre,
			'descripcion' => $this-> descripcion,
			'color' => $this-> color,
			'colorname' => $this-> colorname
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Estado Successfully created.');
    }

    public function edit($id)
    {
        $record = Estado::findOrFail($id);

        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
		$this->descripcion = $record-> descripcion;
		$this->color = $record-> color;
		$this->colorname = $record-> colorname;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'nombre' => 'required',
		'descripcion' => 'required',
		'color' => 'required',
		'colorname' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Estado::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre,
			'descripcion' => $this-> descripcion,
			'color' => $this-> color,
			'colorname' => $this-> colorname
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Estado Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Estado::where('id', $id);
            $record->delete();
        }
    }
}
