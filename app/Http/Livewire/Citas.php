<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Marca;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reparacion;
use App\Models\Taller;
use App\Models\User;
use App\Models\Vehiculo;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Citas extends Component
{
    use WithPagination;
    use WithFileUploads;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $referencia, $descripcion, $fechacita, $tiempoestimado, $fechaingreso, $fechafin, $fechaentrega, $codigodmsasesorservicio, $codigodmsoperadortecnico, $matriculatemporal, $user_id, $estado_id, $vehiculo_id, $taller_id, $tipo_id, $file;
    public $updateMode = false;


    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.citas.view', [
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
                ->Paginate(10)
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
    }

    public function store()
    {
        $this->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $filename = $this->file->store('files','public');
        $filename = storage_path("app/public/$filename");
        $lineas = file($filename);
        $lineas = array_map('utf8_encode', $lineas);
        $citas = array_map('str_getcsv', $lineas);

        for ($i=1; $i < count($citas); $i++) {
            if (!empty($citas[$i]['0'])) {

                // Cargar Clientes
                if(!Cliente::where([
                    'nombre' => $citas[$i]['2'],
                    'apellidopaterno' => $citas[$i]['3'],
                    'apellidomaterno' => $citas[$i]['4']
                    ])->exists()){

                    $cliente = new Cliente();
                    $cliente->nombre = $citas[$i]['2'];
                    $cliente->apellidopaterno = $citas[$i]['3'];
                    $cliente->apellidomaterno = $citas[$i]['4'];
                    $cliente->email = $citas[$i]['5'];
                    $cliente->celular = $citas[$i]['6'];

                    $cliente->save();
                }

                //Cargar Marcas
                if (!Marca::where('prefijo', $citas[$i]['8'])->exists()) {
                    $marca = new Marca();
                    $marca->prefijo = $citas[$i]['8'];

                    $marca->save();
                }

                //Cargar Vehiculos
                if (!Vehiculo::where('vin', $citas[$i]['10'])->exists()) {

                    $vehiculo = new Vehiculo();
                    $vehiculo->vin = $citas[$i]['10'];
                    $vehiculo->matricula = $citas[$i]['9'];
                    $vehiculo->familia = $citas[$i]['11'];
                    $vehiculo->modelo = $citas[$i]['12'];
                    $vehiculo->color = $citas[$i]['13'];
                    $vehiculo->anio = $citas[$i]['14'];

                    $marca = Marca::where('prefijo', $citas[$i]['8'])->first();
                    $vehiculo->marca_id = $marca['id'];

                    $cliente = Cliente::where([
                        'nombre' => $citas[$i]['2'],
                        'apellidopaterno' => $citas[$i]['3'],
                        'apellidomaterno' => $citas[$i]['4']
                        ])->first();
                    $vehiculo->cliente_id = $cliente['id'];

                    $vehiculo->save();
                }

                // Cargar reparaciones
                $referencia = $citas[$i]['0'];
                if (substr($referencia, -1) != "0") {
                    $referencia= substr($referencia, 0, -1).str_repeat('0', 1);
                }

                if (!Reparacion::where('referencia', $referencia)->exists()) {

                    $reparacion = new Reparacion();

                    $fecha = DateTime::createFromFormat('d/m/y', $citas[$i]['15']);
                    $fc = $fecha->format('Y-m-d');

                    $fechacita = $fc." ".$citas[$i]['16'].":00";

                    $reparacion->referencia = $referencia;
                    $reparacion->descripcion = $citas[$i]['17'];
                    $reparacion->fechacita = $fechacita;
                    $reparacion->tiempoestimado = $citas[$i]['18'];
                    $reparacion->codigodmsasesorservicio = $citas[$i]['19'];
                    $reparacion->codigodmsoperadortecnico = $citas[$i]['21'];

                    $reparacion->user_id = auth()->id();

                    $estado = Estado::where('nombre', "CITA")->first();
                    $reparacion->estado_id = $estado->id;

                    $vehiculo = Vehiculo::where('vin', $citas[$i]['10'])->first();
                    $reparacion->vehiculo_id = $vehiculo->id;

                    $taller = Taller::where('numero', $citas[$i]['7'])->first();
                    $reparacion->taller_id = $taller['id'];

                    $reparacion->save();
                }else{
                    $reparacion = Reparacion::where('referencia', $referencia)->first();
                }

                $cliente = Reparacion::find($reparacion->id)->vehiculo->cliente;
                $asesor = User::where('codigodmsasesorservicio', $reparacion->codigodmsasesorservicio)->first();
                $tecnico = User::where('codigodmsoperadortecnico', $reparacion->codigodmsoperadortecnico)->first();

                $reparacion->cliente = $cliente->nombre." ".$cliente->apellidopaterno." ".$cliente->apellidomaterno;
                if (!empty($asesor)) {
                    $reparacion->asesor = $asesor->name." ".$asesor->apellidopaterno;
                }
                if (!empty($tecnico)) {
                    $reparacion->tecnico = $tecnico->name." ".$tecnico->apellidopaterno;
                }
            }
        }

        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', "Se ha cargado el archivo de citas");
    }

}
