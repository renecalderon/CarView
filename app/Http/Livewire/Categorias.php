<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Categoria;

class Categorias extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $categoria, $icono, $color, $colorname;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.categorias.view', [
            'categorias' => Categoria::latest()
						->orWhere('categoria', 'LIKE', $keyWord)
						->orWhere('icono', 'LIKE', $keyWord)
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
		$this->categoria = null;
		$this->icono = null;
		$this->color = null;
		$this->colorname = null;
    }

    public function store()
    {
        $this->validate([
		'categoria' => 'required',
		'icono' => 'required',
		'color' => 'required',
		'colorname' => 'required',
        ]);

        Categoria::create([ 
			'categoria' => $this-> categoria,
			'icono' => $this-> icono,
			'color' => $this-> color,
			'colorname' => $this-> colorname
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Categoria Successfully created.');
    }

    public function edit($id)
    {
        $record = Categoria::findOrFail($id);

        $this->selected_id = $id; 
		$this->categoria = $record-> categoria;
		$this->icono = $record-> icono;
		$this->color = $record-> color;
		$this->colorname = $record-> colorname;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'categoria' => 'required',
		'icono' => 'required',
		'color' => 'required',
		'colorname' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Categoria::find($this->selected_id);
            $record->update([ 
			'categoria' => $this-> categoria,
			'icono' => $this-> icono,
			'color' => $this-> color,
			'colorname' => $this-> colorname
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Categoria Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Categoria::where('id', $id);
            $record->delete();
        }
    }
}
