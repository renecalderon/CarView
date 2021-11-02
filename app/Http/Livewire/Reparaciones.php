<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Evento;
use App\Models\Marca;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reparacion;
use App\Models\Situacion;
use App\Models\Tipo;
use App\Models\User;
use App\Models\Vehiculo;
use Carbon\Carbon;

class Reparaciones extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $referencia, $descripcion, $fechacita, $tiempoestimado, $fechaingreso, $fechafin, $fechaentrega, $codigodmsasesorservicio, $codigodmsoperadortecnico, $matriculatemporal, $user_id, $situacion_id, $vehiculo_id, $taller_id, $tipo_id;
    public $nombre, $apellidopaterno, $apellidomaterno, $email, $celular;
    public $vin, $matricula, $familia, $modelo, $color, $anio, $marca_id, $cliente_id;
    public $eventos;
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
            'situaciones' => Situacion::all(),
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
		$this->situacion_id = null;
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

        $this->eventos = null;
    }

    public function store()
    {
        $this->validate([
		'referencia' => 'required'
        ]);

        $cliente = Cliente::where('nombre', $this->nombre)->
            where('apellidopaterno', $this->apellidopaterno)->
            where('apellidomaterno', $this->apellidomaterno)->
            first();
        if (empty($cliente->id)) {
            $cliente = new Cliente();
            $cliente->nombre = $this->nombre;
            $cliente->apellidopaterno = $this->apellidopaterno;
            $cliente->apellidomaterno = $this->apellidomaterno;
            $cliente->email = $this->email;
            $cliente->celular = $this->celular;
            $cliente->save();
        }else{
            $cliente->update([
                'email' => $this->email,
                'celular' => $this->celular
            ]);
        }

        $vehiculo = Vehiculo::where('vin', $this->vin)->first();

        if (empty($vehiculo->id)) {
            $vehiculo = new Vehiculo();
            $vehiculo->vin = $this->vin;
            $vehiculo->matricula = $this->matricula;
            $vehiculo->familia = $this->familia;
            $vehiculo->modelo = $this->modelo;
            $vehiculo->color = $this->color;
            $vehiculo->anio = $this->anio;
            $vehiculo->marca_id = $this->marca_id;
            $vehiculo->cliente_id = $cliente->id;
            $vehiculo->save();
        }else{
            $vehiculo->update([
                'vin' => $this->vin,
                'matricula' => $this->matricula,
                'familia' => $this->familia,
                'modelo' => $this->modelo,
                'color' => $this->color,
                'anio' => $this->anio,
                'marca_id' => $this->marca_id,
                'cliente_id' => $cliente->id,
            ]);
        }

        $reparacion = Reparacion::where('matriculatemporal', $this->matricula)->where('fechaingreso', Carbon::today())->first();
        if (empty($reparacion->id)) {
            $reparacion = new Reparacion();
            $reparacion->referencia = $this->referencia;
            $reparacion->tipo_id = $this->tipo_id;
            $reparacion->situacion_id = $this->situacion_id;
            $reparacion->codigodmsasesorservicio = $this->codigodmsasesorservicio;
            $reparacion->codigodmsoperadortecnico = $this->codigodmsoperadortecnico;
            $reparacion->descripcion = $this->descripcion;
            $reparacion->vehiculo_id = $this->vehiculo_id;
        }else{
            $reparacion->update([
                'referencia' => $this->referencia,
                'tipo_id' => $this->tipo_id,
                'situacion_id' => $this->situacion_id,
                'codigodmsasesorservicio' => $this->codigodmsasesorservicio,
                'codigodmsoperadortecnico' => $this->codigodmsoperadortecnico,
                'descripcion' => $this->descripcion
            ]);
        }

        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Orden de servicio creada.');
    }

    public function edit($id)
    {
        $reparacion = Reparacion::find($id);

        $this->selected_id = $id;
		$this->referencia = $reparacion-> referencia;
		$this->descripcion = $reparacion-> descripcion;
		$this->fechacita = $reparacion-> fechacita;
		$this->tiempoestimado = $reparacion-> tiempoestimado;
		$this->fechaingreso = $reparacion-> fechaingreso;
		$this->fechafin = $reparacion-> fechafin;
		$this->fechaentrega = $reparacion-> fechaentrega;
		$this->codigodmsasesorservicio = $reparacion-> codigodmsasesorservicio;
		$this->codigodmsoperadortecnico = $reparacion-> codigodmsoperadortecnico;
		$this->matriculatemporal = $reparacion-> matriculatemporal;
		$this->user_id = $reparacion-> user_id;
		$this->situacion_id = $reparacion-> situacion_id;
		$this->vehiculo_id = $reparacion-> vehiculo_id;
		$this->taller_id = $reparacion-> taller_id;
		$this->tipo_id = $reparacion-> tipo_id;

        $vehiculo = Vehiculo::find($this->vehiculo_id);
        $cliente = Cliente::find($vehiculo->cliente_id);

        $this->nombre = $cliente->nombre;
        $this->apellidopaterno = $cliente->apellidopaterno;
        $this->apellidomaterno = $cliente->apellidomaterno;
        $this->email = $cliente->email;
        $this->celular = $cliente->celular;

        $this->vin = $vehiculo->vin;
        $this->matricula = $vehiculo->matricula;
        $this->marca_id = $vehiculo->marca_id;
        $this->familia = $vehiculo->familia;
        $this->modelo = $vehiculo->modelo;
        $this->color = $vehiculo->color;
        $this->anio = $vehiculo->anio;

        $this->eventos = Evento::where('reparacion_id', $reparacion->id)->get();

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
        'referencia' => 'required',
        ]);

        if ($this->selected_id) {
			$reparacion = Reparacion::find($this->selected_id);

            $cliente_id = $reparacion->vehiculo->cliente->id;
            $vehiculo_id = $reparacion->vehiculo->id;

            // Actualizar o crear Cliente
            if ($reparacion->vehiculo->cliente->nombre != $this->nombre ||
                $reparacion->vehiculo->cliente->apellidopaterno != $this->apellidopaterno ||
                $reparacion->vehiculo->cliente->apellidomaterno != $this->apellidomaterno ||
                $reparacion->vehiculo->cliente->email != $this->email ||
                $reparacion->vehiculo->cliente->celular != $this->celular) {

                if ($reparacion->vehiculo->cliente->nombre == $this->nombre ||
                    $reparacion->vehiculo->cliente->apellidopaterno == $this->apellidopaterno ||
                    $reparacion->vehiculo->cliente->apellidomaterno == $this->apellidomaterno) {

                    $reparacion->vehiculo->cliente->update([
                        'email' => $this->email,
                        'celular' => $this->celular
                    ]);
                }else{
                    $cliente = Cliente::where('nombre', $this->nombre)->
                        where('apellidopaterno', $this->apellidopaterno)->
                        where('apellidomaterno', $this->apellidomaterno)->
                        first();
                    if (empty($cliente->id)) {
                        $cliente = new Cliente();
                        $cliente->nombre = $this->nombre;
                        $cliente->apellidopaterno = $this->apellidopaterno;
                        $cliente->apellidomaterno = $this->apellidomaterno;
                        $cliente->email = $this->email;
                        $cliente->celular = $this->celular;
                        $cliente->save();

                        $cliente_id = $cliente->id;
                    }else{
                        $cliente->update([
                            'email' => $this->email,
                            'celular' => $this->celular
                        ]);

                        $cliente_id = $cliente->id;
                    }
                }
            }

            // Actualizar o crear vehiculo
            if ($reparacion->vehiculo->vin != $this->vin ||
                $reparacion->vehiculo->matricula != $this->matricula ||
                $reparacion->vehiculo->familia != $this->familia ||
                $reparacion->vehiculo->modelo != $this->modelo ||
                $reparacion->vehiculo->color != $this->color ||
                $reparacion->vehiculo->anio != $this->anio ||
                $reparacion->vehiculo->marca_id != $this->marca_id ||
                $reparacion->vehiculo->cliente_id != $cliente_id) {

                if ($reparacion->vehiculo->vin == $this->vin) {
                    $reparacion->vehiculo->update([
                        'vin' => $this->vin,
                        'matricula' => $this->matricula,
                        'familia' => $this->familia,
                        'modelo' => $this->modelo,
                        'color' => $this->color,
                        'anio' => $this->anio,
                        'marca_id' => $this->marca_id,
                        'cliente_id' => $cliente_id
                    ]);
                }else{

                    $vehiculo = Vehiculo::where('vin', $this->vin)->first();

                    if (empty($vehiculo->id)) {
                        $vehiculo = new Vehiculo();
                        $vehiculo->vin = $this->vin;
                        $vehiculo->matricula = $this->matricula;
                        $vehiculo->familia = $this->familia;
                        $vehiculo->modelo = $this->modelo;
                        $vehiculo->color = $this->color;
                        $vehiculo->anio = $this->anio;
                        $vehiculo->marca_id = $this->marca_id;
                        $vehiculo->cliente_id = $cliente_id;
                        $vehiculo->save();

                        $vehiculo_id = $vehiculo->id;
                    }else{
                        $vehiculo->update([
                            'vin' => $this->vin,
                            'matricula' => $this->matricula,
                            'familia' => $this->familia,
                            'modelo' => $this->modelo,
                            'color' => $this->color,
                            'anio' => $this->anio,
                            'marca_id' => $this->marca_id,
                            'cliente_id' => $cliente_id
                        ]);

                        $vehiculo_id = $vehiculo->id;
                    }
                }
            }

            if ($reparacion->situacion_id != $this->situacion_id) {
                $situacion = Situacion::select('nombre', 'descripcion')->find($this->situacion_id);
                $categoria = Categoria::select('id')->where('categoria', 'Asesor')->first();
                $evento = new Evento();
                $evento->comentario = $situacion->nombre.' , '.$situacion->descripcion;
                $evento->categoria_id = $categoria->id;
                $evento->reparacion_id = $reparacion->id;
                $evento->user_id = auth()->id();
                $evento->created_at = date("Y-m-d H:i:s");
                $evento->save();
            }

            $reparacion->update([
                'referencia' => $this-> referencia,
                'descripcion' => $this-> descripcion,
                'fechacita' => $this-> fechacita,
                'tiempoestimado' => $this-> tiempoestimado,
                'fechaingreso' => $this-> fechaingreso,
                'fechafin' => $this-> fechafin,
                'fechaentrega' => $this-> fechaentrega,
                'codigodmsasesorservicio' => $this-> codigodmsasesorservicio,
                'codigodmsoperadortecnico' => $this-> codigodmsoperadortecnico,
                'matriculatemporal' => $this-> matriculatemporal,
                'user_id' => $this-> user_id,
                'situacion_id' => $this-> situacion_id,
                'vehiculo_id' => $vehiculo_id,
                'taller_id' => $this-> taller_id,
                'tipo_id' => $this-> tipo_id
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Referencia actualizada.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            //$record = Reparacion::where('id', $id);
            //$record->delete();
        }
    }
}
