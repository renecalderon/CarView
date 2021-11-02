<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Marca;
use App\Models\Propuesta;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Refaccion;
use App\Models\Reparacion;
use App\Models\Tipo;
use App\Models\User;
use App\Models\Vehiculo;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Refacciones extends Component
{
    use WithPagination;
    use WithFileUploads;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $referencia, $descripcion, $fechacita, $tiempoestimado, $fechaingreso, $fechafin, $fechaentrega, $codigodmsasesorservicio, $codigodmsoperadortecnico, $matriculatemporal, $user_id, $estado_id, $vehiculo_id, $taller_id, $tipo_id, $file;
    public $nombre, $apellidopaterno, $apellidomaterno, $email, $celular;
    public $vin, $matricula, $familia, $modelo, $color, $anio, $marca_id, $cliente_id;
    public $asesorasignado, $tecnicoasignado;
    public $filenames;
    public $datos = [];
    public $refacciones;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.refacciones.view', [
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
        $this->asesorasignado = null;
        $this->tecnicoasignado = null;
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

        $this->filenames = null;
        $this->datos = null;

        $this->refacciones = null;
    }

    public function store()
    {
        $this->resetInput();

        /* $this->validate([
		'parte' => 'required',
		'descripcion' => 'required',
		'cantidad' => 'required',
		'precio' => 'required',
        ]);

        Refaccion::create([
			'parte' => $this-> parte,
			'descripcion' => $this-> descripcion,
			'cantidad' => $this-> cantidad,
			'precio' => $this-> precio,
			'propuesta_id' => $this-> propuesta_id
        ]);

        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Refaccione Successfully created.'); */
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

        if (!empty($record->codigodmsasesorservicio)) {
            $asesorasignado = User::where('codigodmsasesorservicio', $record->codigodmsasesorservicio)->first();
            if (!empty($asesorasignado->name)) {
                $this->asesorasignado = $asesorasignado->name;
            }
        }

        $this->refacciones = Refaccion::where('reparacion_id', $id)->count();

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'filenames' => 'required',
            'filenames.*' => 'required',
        ]);

        foreach ($this->filenames as $key => $file) {

            //$propuesta = new Propuesta;
            //$propuesta->nombre_propuesta = 'Nueva Propuesta';
            //$propuesta->reparacion_id = $this->selected_id;
            //$propuesta->save();

            $datos[$key]['filename'] = $file->getClientOriginalName();
            $datos[$key]['total'] = 0;
            $datos[$key]['reparacion_id'] = $this->selected_id;
            //$datos[$key]['propuesta_id'] = $propuesta->id;

            $archivo = $file->store('propuestas','public');
            //$archivo = $file->store('propuestas','public');
            $datos[$key]['path'] = $archivo;
            $archivo = storage_path("app/public/$archivo");

            $parseador = new \Smalot\PdfParser\Parser();
            $documento = $parseador->parseFile($archivo);
            $texto = $documento->getText();
            $texto = str_replace("\t", '|', $texto);
            $texto = str_replace(" yb", '|', $texto);
            $texto = str_replace("$ ", '|', $texto);
            $lineas = preg_split("/[\r\n]+/", $texto);

            $ajuste = Str::contains($texto, 'Ajuste');

            $datos[$key]['hashfile'] = md5_file($file->getRealPath());

            for ($i=0; $i < count($lineas); $i++) {

                // Identificar el VIN
                if (preg_match("/[0-9A-Z]{17}/", $lineas[$i]) && empty($datos[$key]['vin'])) {
                    $datos[$key]['vin'] = str_replace("|", '', $lineas[$i]);
                }

                // Identificar linea con numero de parte
                if (preg_match("/[0-9]{5}-[0-9A-Z]{5}\|.*\|\|/", $lineas[$i])) {
                    $array = explode('|', $lineas[$i]);

                    // Verificar que inicie la linea con numero de parte
                    if ( preg_match("/^[0-9]{5}-[0-9A-Z]{5}\|.*\|\|/", $lineas[$i]) ) {
                        $x = $ajuste ? 5 : 3;
                        $datos[$key]['conceptos'][] = [
                            'descripcion' => $lineas[$i-2]." ".$lineas[$i-1],
                            'parte' => $array['0'],
                            'cantidad' => $array[$x],
                            'precio' => (double)filter_var($array['7'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
                        ];
                        $datos[$key]['total'] += (double)filter_var($array['7'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    }else{
                        $x = $ajuste ? 6 : 4;
                        $datos[$key]['conceptos'][] = [
                            'descripcion' => $array['0'],
                            'parte' => $array['1'],
                            'cantidad' => $array[$x],
                            'precio' => (double)filter_var($array['8'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
                        ];
                        $datos[$key]['total'] += (double)filter_var($array['8'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    }
                }
            }
        }

        foreach ($datos as $key => $info) {
            /* $propuesta = Propuesta::find($info['propuesta_id']);
            $propuesta->update([
                'filename' => $info['filename'],
                'path' => $info['path'],
                'hashfile' => $info['hashfile'],
                'vin' => $info['vin'],
                'total' => $info['total'],
            ]); */

            /* foreach ($info['conceptos'] as $valor) {
                $refaccion = new Refaccion;
                $refaccion->parte = $valor['parte'];
                $refaccion->descripcion = $valor['descripcion'];
                $refaccion->cantidad = $valor['cantidad'];
                $refaccion->precio = $valor['precio'];
                $refaccion->propuesta_id = $datos[$key]['propuesta_id'];
                $refaccion->save();
            } */

            $refaccion = New Refaccion;
            $refaccion->reparacion_id = $this->selected_id;
            $refaccion->vin = $info['vin'];
            $refaccion->total = $info['total'];
            $refaccion->filename = $info['filename'];
            $refaccion->path = $info['path'];
            $refaccion->hashfile = $info['hashfile'];
            $refaccion->save();

        }

        $this->resetInput();
        $this->updateMode = false;
        session()->flash('message', 'Se han almacenado los archivos.');
    }

    public function destroy($id)
    {
        if ($id) {
            $file = Refaccion::select('path')->find($id);
            Storage::disk('public')->delete($file->path);
            Refaccion::find($id)->delete();
        }
    }
}
