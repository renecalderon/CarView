<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Empresa;

class Empresas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $rfc, $razonsocial;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.empresas.view', [
            'empresas' => Empresa::latest()
                ->orWhere('rfc', 'LIKE', $keyWord)
                ->orWhere('razonsocial', 'LIKE', $keyWord)
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
		$this->rfc = null;
		$this->razonsocial = null;
    }

    public function store()
    {
        $this->validate([
		'rfc' => 'required',
		'razonsocial' => 'required',
        ]);

        Empresa::create([
			'rfc' => $this-> rfc,
			'razonsocial' => $this-> razonsocial
        ]);

        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Empresa creada.');
    }

    public function edit($id)
    {
        $record = Empresa::findOrFail($id);

        $this->selected_id = $id;
		$this->rfc = $record-> rfc;
		$this->razonsocial = $record-> razonsocial;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'rfc' => 'required',
		'razonsocial' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Empresa::find($this->selected_id);
            $record->update([
			'rfc' => $this-> rfc,
			'razonsocial' => $this-> razonsocial
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Empresa actualizada.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Empresa::where('id', $id);
            $record->delete();
        }
    }
}
