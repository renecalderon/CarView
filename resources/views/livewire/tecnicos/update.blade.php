<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="card card-tabs">
                <div class="card-header p-0 pt-1 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <li class="pt-2 px-3"><h4 class="card-title">{{$referencia}}</h4></li>
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-three-reparacion-tab" data-toggle="pill" href="#custom-tabs-three-reparacion" role="tab" aria-controls="custom-tabs-three-reparacion" aria-selected="true">Orden de Servicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-propuesta-tab" data-toggle="pill" href="#custom-tabs-three-propuesta" role="tab" aria-controls="custom-tabs-three-propuesta" aria-selected="false">Propuestas</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-three-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-three-reparacion" role="tabpanel" aria-labelledby="custom-tabs-three-reparacion-tab">
                            {{-- <input type="hidden" wire:model.defer="selected_id"> --}}
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
                        <div class="tab-pane fade" id="custom-tabs-three-propuesta" role="tabpanel" aria-labelledby="custom-tabs-three-propuesta-tab">
                            Informacion de Propuestas
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                {{-- <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Guardar</button> --}}
            </div>
        </div>
    </div>
</div>
