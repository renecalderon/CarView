<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Marca;
use App\Models\Propuesta;
use App\Models\Reparacion;
use App\Models\Semaforo;
use App\Models\Situacion;
use App\Models\Status;
use App\Models\Tipo;
use App\Models\User;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class ReparacionController extends Controller
{
    public function index()
    {
        return view('livewire.reparaciones.index');
    }

    public function create()
    {
        $tipos = Tipo::all();
        $situaciones = Situacion::all();
        $marcas = Marca::all();


        $asesores = User::where('sucursal_id','=',auth()->user()->sucursal_id)->whereNotNull('codigodmsasesorservicio')->get();
        $tecnicos = User::where('sucursal_id','=',auth()->user()->sucursal_id)->whereNotNull('codigodmsoperadortecnico')->get();

        return view('admin.reparaciones.create', compact('tipos', 'situaciones', 'marcas', 'asesores', 'tecnicos',));
    }

    public function store(Request $request)
    {
        $cliente = Cliente::where('nombre', $request->nombre)->where('apellidopaterno', $request->apellidopaterno)->where('apellidomaterno', $request->apellidomaterno)->get();
        if (!empty($cliente->id)) {
            $cliente->update($request->all());
        }else{
            $cliente = Cliente::create($request->all());
            $request->request->add(['cliente_id' => "$cliente->id"]);
        }

        $vehiculo = Vehiculo::first('vin', $request->vin);
        if (!empty($vehiculo->id)) {
            $vehiculo->update($request->all());
        }else{
            $vehiculo = Vehiculo::create($request->all());
            $request->request->add(['vehiculo_id' => "$vehiculo->id"]);
        }

        $request->request->add(['user_id' => auth()->id()]);

        Reparacion::create($request->all());

        session()->flash('message', 'Orden de servicio creada.');
        return redirect()->route('admin.reparaciones.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $reparacion = Reparacion::find($id);
        //$vehiculo = Vehiculo::find($reparacion->vehiculo_id);
        //$cliente = Cliente::find($vehiculo->cliente_id);

        $tipos = Tipo::all();
        $situaciones = Situacion::all();
        $marcas = Marca::all();
        $semaforos = Semaforo::all();
        $estados = Estado::all();

        $asesores = User::where('sucursal_id','=',auth()->user()->sucursal_id)->whereNotNull('codigodmsasesorservicio')->get();
        $tecnicos = User::where('sucursal_id','=',auth()->user()->sucursal_id)->whereNotNull('codigodmsoperadortecnico')->get();

        $propuestas = Propuesta::where('reparacion_id', $reparacion->id)->get();

        return view('admin.reparaciones.edit', compact('reparacion', 'tipos', 'situaciones', 'marcas', 'semaforos', 'asesores', 'tecnicos', 'propuestas', 'estados'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'referencia' => 'required|numeric',
            'descripcion' => 'required',
            'nombre' => 'required',

        ]);

        if (!empty($request->manodeobra)) {
            foreach ($request->manodeobra as $key => $manodeobra) {
                $propuesta = Propuesta::find($key);
                $propuesta->update([
                    'manodeobra' => str_replace(',','',$manodeobra),
                ]);
            }
            foreach ($request->status as $key => $state) {
                $propuesta = Propuesta::find($key);
                $propuesta->update([
                    'estado_id' => $state,
                ]);
            }
        }

        $reparacion = Reparacion::find($id);

        if (!empty($reparacion->vehiculo_id)) {
            $vehiculo = Vehiculo::find($reparacion->vehiculo_id);
            if (!empty($vehiculo->cliente_id)) {
                $cliente = Cliente::find($vehiculo->cliente_id);
                $cliente->update($request->all());
            }else{
                $cliente = Cliente::where('nombre', $request->nombre)->where('apellidopaterno', $request->apellidopaterno)->where('apellidomaterno', $request->apellidomaterno)->get();
                if (!empty($cliente->id)) {
                    $cliente->update($request->all());
                }else{
                    $cliente = Cliente::create($request->all());
                    $request->request->add(['cliente_id' => "$cliente->id"]);
                }
            }
            $vehiculo->update($request->all());
        }else{
            $cliente = Cliente::where('nombre', $request->nombre)->where('apellidopaterno', $request->apellidopaterno)->where('apellidomaterno', $request->apellidomaterno)->get();
            if (!empty($cliente->id)) {
                $cliente->update($request->all());
            }else{
                $cliente = Cliente::create($request->all());
            }

            $request->request->add(['cliente_id' => "$cliente->id"]);
            $vehiculo = Vehiculo::first('vin', $request->vin);

            if (!empty($vehiculo->id)) {
                $vehiculo->update($request->all());
            }else{
                $vehiculo = Vehiculo::create($request->all());
                $request->request->add(['vehiculo_id' => "$vehiculo->id"]);
            }
        }

        $reparacion->update($request->all());

        session()->flash('message', 'Orden de servicio actualizada.');
        return redirect()->route('admin.reparaciones.index');
    }

    public function destroy($id)
    {
        //
    }
}
