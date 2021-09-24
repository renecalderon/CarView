<?php

namespace App\Http\Livewire;

use App\Models\Sucursal;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class Users extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $apellidopaterno, $apellidomaterno, $codigodms, $email, $sucursal_id, $password, $confirmar_password;
    public $codigodmsasesorservicio, $codigodmsoperadortecnico;

public $userRoles;
public $nuevosRoles = [];


    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.users.view', [
            'users' => User::latest()
						->orWhere('name', 'LIKE', $keyWord)
						->orWhere('apellidopaterno', 'LIKE', $keyWord)
						->orWhere('apellidomaterno', 'LIKE', $keyWord)
						->orWhere('codigodmsasesorservicio', 'LIKE', $keyWord)
                        ->orWhere('codigodmsoperadortecnico', 'LIKE', $keyWord)
						->orWhere('email', 'LIKE', $keyWord)
						->paginate(10),
            'sucursales' => Sucursal::all(),
            'roles' => Role::all(),
            //'permisos' => Permission::all(),
        ]);
    }

    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }

    private function resetInput()
    {
		$this->name = null;
		$this->apellidopaterno = null;
		$this->apellidomaterno = null;
		$this->email = null;
		$this->sucursal_id = null;
        $this->roles = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'apellidopaterno' => 'required',
            'apellidomaterno' => 'required',
            'email' => 'required|email|string|unique:users',
            'sucursal_id' => 'required',
            'password' => 'min:6|required_with:confirmar_password|same:confirmar_password',
            'confirmar_password' => 'required',
        ]);


        User::create([
			'name' => $this-> name,
			'apellidopaterno' => $this-> apellidopaterno,
			'apellidomaterno' => $this-> apellidomaterno,
			'codigodmsasesorservicio' => $this->codigodmsasesorservicio,
            'codigodmsoperadortecnico' => $this->codigodmsoperadortecnico,
			'email' => $this-> email,
			'sucursal_id' => $this-> sucursal_id,
            'password' => Hash::make($this->password),
        ]);

        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Usuario creado.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $this->selected_id = $id;
		$this->name = $user-> name;
		$this->apellidopaterno = $user-> apellidopaterno;
		$this->apellidomaterno = $user-> apellidomaterno;
		$this->codigodmsasesorservicio = $user-> codigodmsasesorservicio;
        $this->codigodmsoperadortecnico = $user-> codigodmsoperadortecnico;
		$this->email = $user-> email;
		$this->sucursal_id = $user-> sucursal_id;

        //////////////////////////
        $this->userRoles = $user->roles->pluck('name');

        //////////////////////////

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'apellidopaterno' => 'required',
            'apellidomaterno' => 'required',
            'email' => 'required',
            'sucursal_id' => 'required',
            'password' => 'min:6|required_with:confirmar_password|same:confirmar_password',
            'confirmar_password' => 'required',
        ]);

        if ($this->selected_id) {
			$record = User::find($this->selected_id);
            $record->update([
                'name' => $this-> name,
                'apellidopaterno' => $this-> apellidopaterno,
                'apellidomaterno' => $this-> apellidomaterno,
                'codigodmsasesorservicio' => $this-> codigodmsasesorservicio,
                'codigodmsoperadortecnico' => $this-> codigodmsoperadortecnico,
                'email' => $this-> email,
                'sucursal_id' => $this-> sucursal_id,
                'password' => Hash::make($this->password),
            ]);

            //$record->syncRoles([$this->roles]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Usuario actualizado.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = User::where('id', $id);
            $record->delete();
        }
    }
}
