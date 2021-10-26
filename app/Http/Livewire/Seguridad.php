<?php

namespace App\Http\Livewire;

use App\Models\Comentario;
use App\Models\Reparacion;
use App\Models\Situacione;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Monolog\Handler\IFTTTHandler;

class Seguridad extends Component
{
    public $matricula, $placa, $matriculatemporal, $mat1, $mat2, $mat3;
    public function render()
    {
        return view('livewire.seguridad.view');
    }

    public function submit()
    {
        $this->validate([
		'matricula' => 'required|min:6|max:9',
        ]);

        $matricula = strtoupper($this->matricula);
        $matricula = preg_replace("/[^A-Z0-9]+/", "", $matricula);
        $matriculatemporal = $matricula;

        if (preg_match("/^[A-Z]{1}[0-9]{3}[A-Z]{3}$/", $matriculatemporal)) {
            $mat1 = substr($matriculatemporal, 0, 1);
            $mat2 = substr($matriculatemporal, 1, 3);
            $mat3 = substr($matriculatemporal, 4, 3);
            $placa = "$mat1-$mat2-$mat3";
        }elseif(preg_match("/^[A-Z]{1}[0-9]{5}[A-Z]{1}$/", $matriculatemporal)){
            $mat1 = substr($matriculatemporal, 0, 1);
            $mat2 = substr($matriculatemporal, 1, 5);
            $mat3 = substr($matriculatemporal, 6, 1);
            $placa = "$mat1-$mat2-$mat3";
        }elseif(preg_match("/^[A-Z]{3}[0-9]{4}$/", $matriculatemporal)){
            $mat1 = substr($matriculatemporal, 0, 3);
            $mat2 = substr($matriculatemporal, 3, 2);
            $mat3 = substr($matriculatemporal, 5, 2);
            $placa = "$mat1-$mat2-$mat3";
        }elseif(preg_match("/^[A-Z]{3}[0-9]{3}[A-Z]{1}$/", $matriculatemporal)){
            $mat1 = substr($matriculatemporal, 0, 3);
            $mat2 = substr($matriculatemporal, 3, 3);
            $mat3 = substr($matriculatemporal, 6, 1);
            $placa = "$mat1-$mat2-$mat3";
        }elseif(preg_match("/^[A-Z]{2}[0-9]{4}[A-Z]{1}$/", $matriculatemporal)){
            $mat1 = substr($matriculatemporal, 0, 2);
            $mat2 = substr($matriculatemporal, 2, 4);
            $mat3 = substr($matriculatemporal, 6, 1);
            $placa = "$mat1-$mat2-$mat3";
        }else{
            $mat1 = substr($matriculatemporal, 0, 3);
            $mat2 = substr($matriculatemporal, 3, 2);
            $mat3 = substr($matriculatemporal, 5, 2);
            $placa = "$mat1-$mat2-$mat3";
        }

        $vehiculo = Vehiculo::where('matricula', $matricula)->first();
        if (!empty($vehiculo->id)) {
            $reparacion = Reparacion::where('vehiculo_id', '=', $vehiculo->id)->whereDate('fechacita', '=', date('Y-m-d'))->first();
        }

        $this->resetInput();

        if (!empty($reparacion)) {
            if (empty($reparacion->fechaingreso)) {

                if ($reparacion->situacion_id == '1' || empty($reparacion->situacion_id)) {
                    $situacion = Situacione::where('nombre', 'ARRIBO')->first();

                    $reparacion->situacion_id = $situacion->id;
                    $comentario = new Comentario();
                    $comentario->tipo = 'seguridad';
                    $comentario->comentario = $situacion->descripcion;
                    $comentario->reparacion_id = $reparacion->id;
                    $comentario->user_id = auth()->id();
                    $comentario->save();
                }

                $reparacion->fechaingreso = date('Y-m-d h:i:s');
                $reparacion->save();
            }
            session()->flash('message', "$placa, $vehiculo->modelo, $vehiculo->color");
        }else{

            $reparacion = new Reparacion();
            if (!empty($vehiculo->id)) {
                $reparacion->vehiculo_id = $vehiculo->id;
                $mensaje = "$placa, $vehiculo->modelo, $vehiculo->color";
            }elseif(!Reparacion::where('matriculatemporal', '=', $matriculatemporal)->whereDate('fechaingreso', '=', date('Y-m-d'))->first()){
                $reparacion->matriculatemporal = $matriculatemporal;
                $mensaje = "Matricula registrada: $placa";
            }

            $situacion = Situacione::where('nombre', 'ARRIBO')->first();

            $reparacion->descripcion = "Cliente sin Cita";
            $reparacion->fechaingreso = date('Y-m-d h:i:s');
            $reparacion->user_id = auth()->id();
            $reparacion->situacion_id = $situacion->id;
            $reparacion->save();

            $comentario = new Comentario();
            $comentario->tipo = 'seguridad';
            $comentario->comentario = $situacion->descripcion;
            $comentario->reparacion_id = $reparacion->id;
            $comentario->user_id = auth()->id();
            $comentario->save();

            session()->flash('message', "$mensaje");
        }
    }

    private function resetInput()
    {
		$this->matricula = null;
    }

}
