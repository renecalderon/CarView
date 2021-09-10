<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Comentario;
use App\Models\Estado;
use App\Models\Marca;
use App\Models\Reparacion;
use App\Models\Tiempo;
use App\Models\Tipo;
use App\Models\User;
use App\Models\Vehiculo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Tecnicos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $referencia, $descripcion, $fechacita, $tiempoestimado, $fechaingreso, $fechafin, $fechaentrega, $codigodmsasesorservicio, $codigodmsoperadortecnico, $matriculatemporal, $user_id, $estado_id, $vehiculo_id, $taller_id, $tipo_id, $file;
    public $nombre, $apellidopaterno, $apellidomaterno, $email, $celular;
    public $vin, $matricula, $familia, $modelo, $color, $anio, $marca_id, $cliente_id;
    public $comentarios;
    public $asesorasignado, $tecnicoasignado;
    public $estado;
    //public $tiempos = [];
    public $tareapendiente;
    public $updateMode = false;

    public function render()
    {
        $keyWord = '%'.$this->keyWord .'%';
        return view('livewire.tecnicos.view', [
            /* 'reparaciones' => Reparacion::whereDate('updated_at', Carbon::today()) */
            'reparaciones' => Reparacion::latest()->orderBy('updated_at', 'DESC')
                ->orWhere('referencia', 'LIKE', $keyWord)
                ->orWhere('descripcion', 'LIKE', $keyWord)
                ->orWhere('fechacita', 'LIKE', $keyWord)
                ->orWhere('fechaingreso', 'LIKE', $keyWord)
                ->orWhereHas('vehiculo', function ( $query ) use ( $keyWord ){
                    $query->where("modelo", "LIKE", "%" . $keyWord . "%")
                        ->orWhere("vin", "LIKE", "%" . $keyWord . "%")
                        ->orWhere("matricula", "LIKE", "%" . $keyWord . "%")
                    ->orWhereHas('cliente', function ( $query ) use ( $keyWord ){
                        $query->where("nombre", "LIKE", "%" . $keyWord . "%")
                            ->orWhere("celular", "LIKE", "%" . $keyWord . "%")
                            ->orWhere("apellidopaterno", "LIKE", "%" . $keyWord . "%")
                            ->orWhere("apellidomaterno", "LIKE", "%" . $keyWord . "%")
                            ->orWhereRaw("concat(nombre, ' ', apellidopaterno, ' ', apellidomaterno) like '%$keyWord%' ");
                    });
                })
                ->Paginate(5),

            'marcas' => Marca::all(),
            'estados' => Estado::all(),
            'tipos' => Tipo::all(),
            'asesores' => User::where('sucursal_id','=',auth()->user()->sucursal_id)->whereNotNull('codigodmsasesorservicio')->get(),
            'tecnicos' => User::where('sucursal_id','=',auth()->user()->sucursal_id)->whereNotNull('codigodmsoperadortecnico')->get(),
        ]);

    }

    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }

    private function resetInput()
    {
		$this->referencia = null;
		$this->descripcion = null;
        $this->asesorasignado = null;
        $this->tecnicoasignado = null;
        $this->nombre = null;
        $this->apellidopaterno = null;
        $this->apellidomaterno = null;
        $this->vin = null;
        $this->matricula = null;
        $this->familia = null;
        $this->modelo = null;
        $this->color = null;
        $this->anio = null;
        $this->comentarios = null;
        $this->codigodmsoperadortecnico = null;
        $this->estado = null;
        $this->tareapendiente = null;

    }

    public function store()
    {
        $this->resetInput();
    }

    public function edit($id)
    {
        $record = Reparacion::findOrFail($id);

        $this->selected_id = $id;
		$this->referencia = $record-> referencia;
		$this->descripcion = $record-> descripcion;
        $this->codigodmsoperadortecnico = $record-> codigodmsoperadortecnico;

        $vehiculo = Vehiculo::findOrFail($record->vehiculo_id);
        $cliente = Cliente::findOrFail($vehiculo->cliente_id);

        $this->nombre = $cliente->nombre;
        $this->apellidopaterno = $cliente->apellidopaterno;
        $this->apellidomaterno = $cliente->apellidomaterno;

        $this->vin = $vehiculo->vin;
        $this->matricula = $vehiculo->matricula;
        $this->familia = $vehiculo->familia;
        $this->modelo = $vehiculo->modelo;
        $this->color = $vehiculo->color;
        $this->anio = $vehiculo->anio;

        if (!empty($record->codigodmsasesorservicio)) {
            $asesorasignado = User::where('codigodmsasesorservicio', $record->codigodmsasesorservicio)->first();
            if (!empty($asesorasignado->name)) {
                $this->asesorasignado = $asesorasignado->name;
            }
        }

        /* if (!empty($record->codigodmsoperadortecnico)) {
            $this->tecnicoasignado = User::where('codigodmsoperadortecnico', $record->codigodmsoperadortecnico)->first();
            if (!empty($this->tecnicoasignado->id)) {
                $tiempos = Tiempo::where('reparacion_id', $this->selected_id)->where('user_id',$this->tecnicoasignado->id)->get();
                if (count($tiempos) >= 1) {
                    $this->tiempos = $tiempos;
                }
            }
        } */

        if (!empty($record->codigodmsoperadortecnico)) {
            $this->tecnicoasignado = User::where('codigodmsoperadortecnico', $record->codigodmsoperadortecnico)->first();
            if (!empty($this->tecnicoasignado->id)) {
                $task = Tiempo::where('reparacion_id', $this->selected_id)
                    ->where('user_id',$this->tecnicoasignado->id)
                    ->whereDate('created_at', Carbon::today())
                    ->whereNull('fin')
                    ->first();

                if (empty($task->id)) {
                    $this->tareapendiente = false;
                }else{
                    $this->tareapendiente = true;
                }
            }
        }


        $status = Estado::find($record->estado_id);
        $this->estado = $status->nombre;

        $this->comentarios = Comentario::where('reparacion_id', '=', $this->selected_id)->orderBy('created_at', 'DESC')->get();

        $this->updateMode = true;
    }

    public function showTareaPendiente($selected_id, $value)
    {
        $this->tecnicoasignado = User::where('codigodmsoperadortecnico', $value)->first();
        //$this->tecnicoasignado = $value;

        $task = Tiempo::where('reparacion_id', $selected_id)
            ->where('user_id',$this->tecnicoasignado->id)
            ->whereDate('created_at', Carbon::today())
            ->whereNull('fin')
            ->first();

        if (empty($task->id)) {
            $this->tareapendiente = false;
        }else{
            $this->tareapendiente = true;
        }
    }


    public function update($selected_id, $tecnicoasignado, $tareapendiente)
    {
        /* $this->validate([
		'codigodmsoperadortecnico' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Reparacion::find($this->selected_id);
            $record->update([
                'codigodmsoperadortecnico' => $this->codigodmsoperadortecnico,
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Registro actualizado');
        } */


        $this->resetInput();
        $this->updateMode = false;
        session()->flash('message', 'Registro actualizado');

    }
}
