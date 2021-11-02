<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Evento;

class Eventos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $comentario, $categoria_id, $user_id, $reparacion_id;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.eventos.view', [
            'eventos' => Evento::latest()
						->orWhere('comentario', 'LIKE', $keyWord)
						->orWhere('categoria_id', 'LIKE', $keyWord)
						->orWhere('user_id', 'LIKE', $keyWord)
						->orWhere('reparacion_id', 'LIKE', $keyWord)
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
		$this->comentario = null;
		$this->categoria_id = null;
		$this->user_id = null;
		$this->reparacion_id = null;
    }

    public function store()
    {
        $this->validate([
		'comentario' => 'required',
		'categoria_id' => 'required',
		'user_id' => 'required',
		'reparacion_id' => 'required',
        ]);

        Evento::create([ 
			'comentario' => $this-> comentario,
			'categoria_id' => $this-> categoria_id,
			'user_id' => $this-> user_id,
			'reparacion_id' => $this-> reparacion_id
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Evento Successfully created.');
    }

    public function edit($id)
    {
        $record = Evento::findOrFail($id);

        $this->selected_id = $id; 
		$this->comentario = $record-> comentario;
		$this->categoria_id = $record-> categoria_id;
		$this->user_id = $record-> user_id;
		$this->reparacion_id = $record-> reparacion_id;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'comentario' => 'required',
		'categoria_id' => 'required',
		'user_id' => 'required',
		'reparacion_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Evento::find($this->selected_id);
            $record->update([ 
			'comentario' => $this-> comentario,
			'categoria_id' => $this-> categoria_id,
			'user_id' => $this-> user_id,
			'reparacion_id' => $this-> reparacion_id
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Evento Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Evento::where('id', $id);
            $record->delete();
        }
    }
}
