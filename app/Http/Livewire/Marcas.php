<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Marca;

class Marcas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $prefijo, $marca;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.marcas.view', [
            'marcas' => Marca::latest()
						->orWhere('prefijo', 'LIKE', $keyWord)
						->orWhere('marca', 'LIKE', $keyWord)
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
		$this->prefijo = null;
		$this->marca = null;
    }

    public function store()
    {
        $this->validate([
		'prefijo' => 'required',
        ]);

        Marca::create([
			'prefijo' => $this-> prefijo,
			'marca' => $this-> marca
        ]);

        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Marca creada.');
    }

    public function edit($id)
    {
        $record = Marca::findOrFail($id);

        $this->selected_id = $id;
		$this->prefijo = $record-> prefijo;
		$this->marca = $record-> marca;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'prefijo' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Marca::find($this->selected_id);
            $record->update([
			'prefijo' => $this-> prefijo,
			'marca' => $this-> marca
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Marca actualizada.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Marca::where('id', $id);
            $record->delete();
        }
    }
}
