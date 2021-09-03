<?php

namespace App\Http\Livewire;

use App\Models\Empresa;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Sucursal;

class Sucursales extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $direccion, $pagina, $telefono, $empresa_id;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.sucursales.view', [
            'sucursales' => Sucursal::latest()
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('direccion', 'LIKE', $keyWord)
						->orWhere('pagina', 'LIKE', $keyWord)
						->orWhere('telefono', 'LIKE', $keyWord)
						->orWhere('empresa_id', 'LIKE', $keyWord)
						->paginate(10),
            'empresas' => Empresa::all(),
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
		$this->direccion = null;
		$this->pagina = null;
		$this->telefono = null;
		$this->empresa_id = null;
    }

    public function store()
    {
        $this->validate([
		'nombre' => 'required',
		'direccion' => 'required',
		'pagina' => 'required',
		'telefono' => 'required',
		'empresa_id' => 'required',
        ]);

        Sucursal::create([
			'nombre' => $this-> nombre,
			'direccion' => $this-> direccion,
			'pagina' => $this-> pagina,
			'telefono' => $this-> telefono,
			'empresa_id' => $this-> empresa_id
        ]);

        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Sucursal creada.');
    }

    public function edit($id)
    {
        $record = Sucursal::findOrFail($id);

        $this->selected_id = $id;
		$this->nombre = $record-> nombre;
		$this->direccion = $record-> direccion;
		$this->pagina = $record-> pagina;
		$this->telefono = $record-> telefono;
		$this->empresa_id = $record-> empresa_id;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'nombre' => 'required',
		'direccion' => 'required',
		'pagina' => 'required',
		'telefono' => 'required',
		'empresa_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Sucursal::find($this->selected_id);
            $record->update([
			'nombre' => $this-> nombre,
			'direccion' => $this-> direccion,
			'pagina' => $this-> pagina,
			'telefono' => $this-> telefono,
			'empresa_id' => $this-> empresa_id
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Sucursal actualizada.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Sucursal::where('id', $id);
            $record->delete();
        }
    }
}
