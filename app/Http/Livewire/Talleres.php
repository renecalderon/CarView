<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Taller;

class Talleres extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $numero, $descripcion, $sucursal_id;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.talleres.view', [
            'talleres' => Taller::latest()
						->orWhere('numero', 'LIKE', $keyWord)
						->orWhere('descripcion', 'LIKE', $keyWord)
						->orWhere('sucursal_id', 'LIKE', $keyWord)
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
		$this->numero = null;
		$this->descripcion = null;
		$this->sucursal_id = null;
    }

    public function store()
    {
        $this->validate([
		'numero' => 'required',
		'descripcion' => 'required',
		'sucursal_id' => 'required',
        ]);

        Taller::create([
			'numero' => $this-> numero,
			'descripcion' => $this-> descripcion,
			'sucursal_id' => $this-> sucursal_id
        ]);

        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Tallere Successfully created.');
    }

    public function edit($id)
    {
        $record = Taller::findOrFail($id);

        $this->selected_id = $id;
		$this->numero = $record-> numero;
		$this->descripcion = $record-> descripcion;
		$this->sucursal_id = $record-> sucursal_id;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'numero' => 'required',
		'descripcion' => 'required',
		'sucursal_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Taller::find($this->selected_id);
            $record->update([
			'numero' => $this-> numero,
			'descripcion' => $this-> descripcion,
			'sucursal_id' => $this-> sucursal_id
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Tallere Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Taller::where('id', $id);
            $record->delete();
        }
    }
}
