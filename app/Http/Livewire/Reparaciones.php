<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Comentario;
use App\Models\Estado;
use App\Models\Marca;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reparacion;
use App\Models\Taller;
use App\Models\Tipo;
use App\Models\User;
use App\Models\Vehiculo;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Reparaciones extends Component
{
    use WithPagination;
    use WithFileUploads;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $referencia, $descripcion, $fechacita, $tiempoestimado, $fechaingreso, $fechafin, $fechaentrega, $codigodmsasesorservicio, $codigodmsoperadortecnico, $matriculatemporal, $user_id, $estado_id, $vehiculo_id, $taller_id, $tipo_id, $file;
    public $nombre, $apellidopaterno, $apellidomaterno, $email, $celular;
    public $vin, $matricula, $familia, $modelo, $color, $anio, $marca_id, $cliente_id;
    public $comentarios;
    public $updateMode = false;


    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.reparaciones.view', [
            'reparaciones' => Reparacion::latest()->orderBy('fechacita', 'DESC')
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
                ->Paginate(10),
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
		$this->fechacita = null;
		$this->tiempoestimado = null;
		$this->fechaingreso = null;
		$this->fechafin = null;
		$this->fechaentrega = null;
		$this->codigodmsasesorservicio = null;
		$this->codigodmsoperadortecnico = null;
		$this->matriculatemporal = null;
		$this->user_id = null;
		$this->estado_id = null;
		$this->vehiculo_id = null;
		$this->taller_id = null;
		$this->tipo_id = null;

        $this->nombre = null;
        $this->apellidopaterno = null;
        $this->apellidomaterno = null;
        $this->email = null;
        $this->celular = null;

        $this->vin = null;
        $this->matricula = null;
        $this->familia = null;
        $this->modelo = null;
        $this->color = null;
        $this->anio = null;

        $this->comentarios = null;
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
		$this->fechacita = $record-> fechacita;
		$this->tiempoestimado = $record-> tiempoestimado;
		$this->fechaingreso = $record-> fechaingreso;
		$this->fechafin = $record-> fechafin;
		$this->fechaentrega = $record-> fechaentrega;
		$this->codigodmsasesorservicio = $record-> codigodmsasesorservicio;
		$this->codigodmsoperadortecnico = $record-> codigodmsoperadortecnico;
		$this->matriculatemporal = $record-> matriculatemporal;
		$this->user_id = $record-> user_id;
		$this->estado_id = $record-> estado_id;
		$this->vehiculo_id = $record-> vehiculo_id;
		$this->taller_id = $record-> taller_id;
		$this->tipo_id = $record-> tipo_id;

        $vehiculo = Vehiculo::findOrFail($this->vehiculo_id);
        $cliente = Cliente::findOrFail($vehiculo->cliente_id);

        $this->nombre = $cliente->nombre;
        $this->apellidopaterno = $cliente->apellidopaterno;
        $this->apellidomaterno = $cliente->apellidomaterno;
        $this->email = $cliente->email;
        $this->celular = $cliente->celular;

        $this->vin = $vehiculo->vin;
        $this->matricula = $vehiculo->matricula;
        $this->familia = $vehiculo->familia;
        $this->modelo = $vehiculo->modelo;
        $this->color = $vehiculo->color;
        $this->anio = $vehiculo->anio;

        $this->comentarios = Comentario::where('reparacion_id', '=', $this->selected_id)->orderBy('created_at', 'DESC')->get();

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'descripcion' => 'required',
		'user_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Reparacion::find($this->selected_id);

            if (empty($this->fechaingreso)) {
                $this->fechaingreso = date('Y-m-d h:i:s');
            }

            // Agregar comentario de cambio de estado de OR
            if ($record->estado_id != $this->estado_id) {
                $estado = Estado::find($this->estado_id);
                $comentario = new Comentario();
                $comentario->tipo = 'asesor';
                $comentario->comentario = $estado->descripcion;
                $comentario->reparacion_id = $this->selected_id;
                $comentario->user_id = auth()->id();
                $comentario->save();
            }

            // Actualizar OR
            $record->update([
                'referencia' => $this->referencia,
                'descripcion' => $this->descripcion,
                'fechacita' => $this->fechacita,
                'tiempoestimado' => $this->tiempoestimado,
                'fechaingreso' => $this->fechaingreso,
                'fechafin' => $this->fechafin,
                'fechaentrega' => $this->fechaentrega,
                'codigodmsasesorservicio' => $this->codigodmsasesorservicio,
                'codigodmsoperadortecnico' => $this->codigodmsoperadortecnico,
                'matriculatemporal' => $this->matriculatemporal,
                'user_id' => $this->user_id,
                'estado_id' => $this->estado_id,
                'vehiculo_id' => $this->vehiculo_id,
                'taller_id' => $this->taller_id,
                'tipo_id' => $this->tipo_id
            ]);

            // Actualizar datos de Cliente
            if ($record->vehiculo->cliente->nombre != $this->nombre ||
                $record->vehiculo->cliente->apellidopaterno != $this->apellidopaterno ||
                $record->vehiculo->cliente->apellidomaterno != $this->apellidomaterno ||
                $record->vehiculo->cliente->email != $this->email ||
                $record->vehiculo->cliente->celular != $this->celular
            ) {
                $record->vehiculo->cliente->update([
                    'nombre' => $this->nombre,
                    'apellidopaterno' => $this->apellidopaterno,
                    'apellidomaterno' => $this->apellidomaterno,
                    'email' => $this->email,
                    'celular' => $this->celular
                ]);
            }

            // Actualizar vehiculo
            if ($record->vehiculo->vin != $this->vin ||
                $record->vehiculo->matricula != $this->matricula ||
                $record->vehiculo->familia != $this->familia ||
                $record->vehiculo->modelo != $this->modelo ||
                $record->vehiculo->color != $this->color ||
                $record->vehiculo->anio != $this->anio ||
                $record->vehiculo->marca_id != $this->marca_id
            ) {
                $record->vehiculo->cliente->update([
                    'vin' => $this->vin,
                    'matricula' => $this->matricula,
                    'familia' => $this->familia,
                    'modelo' => $this->modelo,
                    'color' => $this->color,
                    'anio' => $this->anio,
                    'marca_id' => $this->marca_id
                ]);
            }

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Orden de servicio actualizada.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Reparacion::where('id', $id);
            $record->delete();
        }
    }
}
