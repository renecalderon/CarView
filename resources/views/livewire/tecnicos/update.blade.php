<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="card card-tabs">
                <div class="card-header p-0 pt-1 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <li class="pt-2 px-3"><h4 class="card-title">{{$referencia}}</h4></li>
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-three-reparacion-tab" data-toggle="pill" href="#custom-tabs-three-reparacion" role="tab" aria-controls="custom-tabs-three-reparacion" aria-selected="true">Orden Servicio</a>
                        </li>
                        @if ($numPropuestas > 0)
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-three-propuesta-tab" data-toggle="pill" href="#custom-tabs-three-propuesta" role="tab" aria-controls="custom-tabs-three-propuesta" aria-selected="false">Propuestas
                                    <span class="badge bg-danger">
                                        {{$numPropuestas}}
                                    </span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-three-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-three-reparacion" role="tabpanel" aria-labelledby="custom-tabs-three-reparacion-tab">
                            <div class="card bg-light d-flex flex-fill">
                                <div class="card-header text-muted border-bottom-0">
                                        <h6><code>{{$estado ?? ''}}</code></h6>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-9">
                                            <h5 class="lead">{{$nombre}} {{$apellidopaterno}} {{$apellidomaterno}}</h5>
                                            <p class="text-muted text-sm"><b>Vehiculo: </b> {{$vin}} / {{$matricula}} / {{$modelo}}/ {{$color}} / {{$anio}} </p>
                                        </div>
                                        <div class="col-3 text-center">
                                            <img src="vendor/adminlte/dist/img/logo.png" alt="user-avatar" class="img-circle img-fluid">
                                            <p class="text-muted text-sm">{{$asesorasignado ?? ''}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-tools"></i></span> <h6><b><code>{{$descripcion}}</code></b></h6></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="codigodmsoperadortecnico" class="col-sm-5 col-form-label">Selecciona tu nombre:</label>
                                <div class="col-sm-7">
                                    <select wire:click="showTareaPendiente({{$selected_id}}, $event.target.value)" wire:model="codigodmsoperadortecnico" type="text" class="form-control" id="codigodmsoperadortecnico" placeholder="Seleccione Tecnico">
                                        <option value="">-- Seleccione --</option>
                                        @foreach ($tecnicos as $tecnico)
                                            <option value="{{$tecnico->codigodmsoperadortecnico}}">{{$tecnico->name}} {{$tecnico->apellidopaterno}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @error('codigodmsoperadortecnico')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                @if (!empty($tecnicoasignado))
                                    @if ($task_id !== null)
                                        <button type="button" wire:click.prevent="finalizar({{$task_id}})" class="btn btn-lg btn-danger btn-block" data-dismiss="modal"><i class="fas fa-stop"></i> Finalizar Trabajo <span class="badge bg-success">{{\Carbon\Carbon::parse($task->created_at)->diffForHumans()}}</span></button>
                                    @else
                                        <button type="button" wire:click.prevent="iniciar({{$selected_id}}, {{$tecnicoasignado}})" class="btn btn-lg btn-success btn-block" data-dismiss="modal"><i class="fas fa-play"></i> Iniciar Trabajo</button>
                                    @endif
                                @endif
                            </div>

                        </div>

                        @if ($numPropuestas > 0)
                            <div class="tab-pane fade" id="custom-tabs-three-propuesta" role="tabpanel" aria-labelledby="custom-tabs-three-propuesta-tab">
                                <div class="table-responsive" @if ($numPropuestas == 1) style="min-height:130px;" @endif >
                                    <table class="table m-0 table-sm" >
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>P</th>
                                                <th>Descripcion</th>
                                                <th class="text-right">Total</th>
                                                <th></th>
                                                <th></th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (App\Models\Propuesta::where('reparacion_id', $selected_id)->get() as $index => $propuesta)
                                                <tr>
                                                    <td class='align-middle'>{{ $loop->iteration }}</td>
                                                    <td class='align-middle'><a href="{{url($propuesta->path)}}" target="_blank"><i class="fas fa-file-pdf"></i></a></td>
                                                    <td class='align-middle'>
                                                        <textarea id="{{$propuesta->id}}" wire:model.defer="propuestas.{{$propuesta->id}}.nombre_propuesta" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="{{$propuesta->nombre_propuesta}}" rows="1"></textarea>
                                                    </td>
                                                    <td class="text-right align-middle">{{number_format($propuesta->total, 2, '.', ',')}}</td>
                                                    <td class='align-middle'>
                                                        @foreach ($semaforos as $semaforo)
                                                            @if ($propuesta->semaforo_id == $semaforo->id)
                                                                <i class="nav-icon fas fa-record-vinyl fa-2x text-{{$semaforo->colorname}}"></i>
                                                            @endif
                                                        @endforeach

                                                    </td>
                                                    <td class='align-middle'>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa fa-traffic-light"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                @foreach ($semaforos as $semaforo)
                                                                    <a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="update_semaforo({{$propuesta->id}}, {{$semaforo->id}})"><i class="nav-icon fas fa-record-vinyl text-{{$semaforo->colorname}}"></i> {{$semaforo->nombre}} </a>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal"> <i class="fa fa-times"></i> Cerrar</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>
