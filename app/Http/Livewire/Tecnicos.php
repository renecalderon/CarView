<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Comentario;
use App\Models\Estado;
use App\Models\Marca;
use App\Models\Propuesta;
use App\Models\Reparacion;
use App\Models\Semaforo;
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
    public $task_id, $task;

    public $numPropuestas;
    public $propuestas = [];

    public $semaforos;

    public $updateMode = false;

    public function render()
    {
        $keyWord = '%'.$this->keyWord .'%';
        return view('livewire.tecnicos.view', [
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
        $this->task_id = null;
        $this->task = null;
        $this->numPropuestas = null;
        $this->propuestas = null;
        $this->semaforos = null;

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

        if (!empty($record->codigodmsoperadortecnico)) {
            $tecnicoasignado = User::select('id')->where('codigodmsoperadortecnico', $record->codigodmsoperadortecnico)->first();
            if (!empty($tecnicoasignado->id)) {
                $this->tecnicoasignado = $tecnicoasignado->id;
                $task = Tiempo::where('reparacion_id', $this->selected_id)
                    ->where('tecnico_id',$this->tecnicoasignado)
                    ->where('estado', 'open')
                    ->whereDate('created_at', Carbon::today())
                    ->first();

                if (!empty($task->id)) {
                    $this->task = $task;
                    $this->task_id = $task->id;
                }else{
                    $this->task_id = null;
                }
            }
        }

        $this->numPropuestas = Propuesta::where('reparacion_id', $id)->count();

        $status = Estado::find($record->estado_id);
        $this->estado = $status->nombre;

        $this->semaforos = Semaforo::all();

        $this->updateMode = true;
    }

    public function showTareaPendiente($selected_id, $value)
    {
        $tecnicoasignado = User::select('id')->where('codigodmsoperadortecnico', $value)->first();
        $this->tecnicoasignado = $tecnicoasignado->id;

        $task = Tiempo::where('reparacion_id', $selected_id)
            ->where('tecnico_id',$this->tecnicoasignado)
            ->where('estado', 'open')
            ->whereDate('created_at', Carbon::today())
            ->first();

        if (!empty($task->id)) {
            $this->task = $task;
            $this->task_id = $task->id;
        }else{
            $this->task_id = null;
        }
    }

    public function iniciar($selected_id, $tecnicoasignado)
    {
        Tiempo::create([
            'estado' => 'open',
            'user_id' => auth()->id(),
            'tecnico_id' => $tecnicoasignado,
            'reparacion_id' => $selected_id,
        ]);

        $this->resetInput();
        $this->updateMode = false;
        session()->flash('message', 'Iniciando trabajo...');
    }

    public function finalizar($task_id)
    {
        if ($this->task_id) {
			$record = Tiempo::find($this->task_id);

            $record->update([
                'estado' => 'closed',
            ]);

            $this->resetInput();
            $this->updateMode = false;
            session()->flash('message', 'Trabajo terminado');
        }
    }

    public function update()
    {
        foreach ($this->propuestas as $id => $descripcion) {
            $propuesta = Propuesta::find($id);
            $propuesta->update([
                'nombre_propuesta' => $descripcion['texto'],
            ]);
        }

        $this->resetInput();
        $this->updateMode = false;
        session()->flash('message', 'Descripcion de propuesta actualizada.');
    }
}
