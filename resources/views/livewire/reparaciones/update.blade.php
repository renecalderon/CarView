<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar Orden de Servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">

                    <div class="col-md-5">
                        <div class="card card-widget widget-user-2 shadow-sm">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="timeline">
                                        {{$fechaevento = null}}
                                        @foreach (App\Models\Evento::where('reparacion_id', $selected_id)->orderBy('created_at', 'DESC')->get() as $evento)
                                            @if ($fechaevento !== \Carbon\Carbon::parse($evento->created_at)->format('Y-m-d'))
                                                <div class="time-label">
                                                    <span class="bg-red">{{\Carbon\Carbon::parse($evento->created_at)->format('d F Y')}}</span>
                                                </div>
                                            @endif

                                            @php($fechaevento = \Carbon\Carbon::parse($evento->created_at)->format('Y-m-d'))

                                            <div>
                                                <i class="fas fa-{{$evento->categoria->icono}} bg-{{$evento->categoria->colorname}}" title="{{$evento->created_at}}"></i>
                                                <div class="timeline-item">
                                                    <span class="time" title="{{$evento->created_at}}"><i class="fas fa-clock"></i> {{\Carbon\Carbon::parse($evento->created_at)->diffForHumans()}}</span>
                                                    <h3 class="timeline-header no-border"><a href="#">{{$evento->user->name}}</a>: <span style="text-transform: lowercase;">{{$evento->comentario}}</span></h3>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-tab" role="tablist">
                                    <li class="nav-item" wire:ignore>
                                        <a class="nav-link active" id="custom-tabs-reparacion-update-tab" data-toggle="pill" href="#custom-tabs-reparacion-update" role="tab" aria-controls="custom-tabs-reparacion-update" aria-selected="true"><i class="fas fa-grip-vertical text-danger"></i> Referencia</a>
                                    </li>
                                    <li class="nav-item" wire:ignore>
                                        <a class="nav-link" id="custom-tabs-cliente-update-tab" data-toggle="pill" href="#custom-tabs-cliente-update" role="tab" aria-controls="custom-tabs-cliente-update" aria-selected="false"><i class="fas fa-user text-danger"></i> Cliente</a>
                                    </li>
                                    <li class="nav-item" wire:ignore>
                                        <a class="nav-link" id="custom-tabs-vehiculo-update-tab" data-toggle="pill" href="#custom-tabs-vehiculo-update" role="tab" aria-controls="custom-tabs-vehiculo-update" aria-selected="false"><i class="fas fa-car text-danger"></i> Vehiculo</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">

                                <form>
                                    <input type="hidden" wire:model="selected_id">
                                    <div class="tab-content" id="custom-tabs-tabContent">
                                        <div class="tab-pane fade show active" id="custom-tabs-reparacion-update" role="tabpanel" aria-labelledby="custom-tabs-reparacion-update-tab" wire:ignore.self>

                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label for="referencia" class="col-form-label">Referencia</label>
                                                    <input wire:model="referencia" id="referencia" type="text" class="form-control" placeholder="Referencia">
                                                    @error('referencia')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-5">
                                                    <label for="tipo_id" class="col-sm-4 col-form-label">Tipo</label>
                                                    <select wire:model.ignore="tipo_id" id="tipo_id" type="text" class="form-control" placeholder="Seleccione Tipo de OR">
                                                        <option value="">-- Seleccione --</option>
                                                        @foreach ($tipos as $tipo)
                                                            <option value="{{$tipo->id}}"
                                                            @if ($tipo_id == $tipo->id)
                                                                selected
                                                            @endif
                                                            >{{$tipo->nombre}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('tipo_id')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="situacion_id" class="col-sm-4 col-form-label">Estado</label>
                                                    <select wire:model.ignore="situacion_id" type="text" class="form-control" id="situacion_id" placeholder="Estado">
                                                        <option value="">-- Seleccione --</option>
                                                        @foreach ($situaciones as $situacion)
                                                            <option value="{{$situacion->id}}"
                                                            @if ($situacion_id == $situacion->id)
                                                                selected
                                                            @endif
                                                            >{{$situacion->nombre}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('situacion_id')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label for="codigodmsasesorservicio" class="col-form-label">Asesor asignado</label>
                                                    <select wire:model.ignore="codigodmsasesorservicio" class="form-control" id="codigodmsasesorservicio" placeholder="Seleccione Asesor">
                                                        <option value="">-- Seleccione --</option>
                                                        @foreach ($asesores as $asesor)
                                                            <option value="{{$asesor->codigodmsasesorservicio}}"
                                                            @if ($codigodmsasesorservicio == $asesor->codigodmsasesorservicio)
                                                                selected
                                                            @endif
                                                            >{{$asesor->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('codigodmsasesorservicio')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="codigodmsoperadortecnico" class="col-form-label">Tecnico asignado</label>
                                                    <select wire:model.ignore="codigodmsoperadortecnico" class="form-control" id="codigodmsoperadortecnico" placeholder="Seleccione Tecnico">
                                                        <option value="">-- Seleccione --</option>
                                                        @foreach ($tecnicos as $tecnico)
                                                            <option value="{{$tecnico->codigodmsoperadortecnico}}"
                                                            @if ($codigodmsoperadortecnico == $tecnico->codigodmsoperadortecnico)
                                                                selected
                                                            @endif
                                                            >{{$tecnico->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('codigodmsoperadortecnico')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="descripcion" class="col-form-label">Descripcion</label>
                                                    <input wire:model="descripcion" id="descripcion" onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control" placeholder="Ingrese la descripcion">
                                                    @error('descripcion')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-cliente-update" role="tabpanel" aria-labelledby="custom-tabs-cliente-update-tab" wire:ignore.self>

                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label for="nombre" class="col-form-label">Nombre o Razon Social</label>
                                                            <input wire:model="nombre" id="nombre" onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control" placeholder="Nombre o Razon Social">
                                                            @error('nombre')
                                                                <span class="error text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label for="apellidopaterno" class="col-form-label">Apellido Paterno</label>
                                                            <input wire:model="apellidopaterno" id="apellidopaterno" onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control" placeholder="Apellido Paterno">
                                                            @error('apellidopaterno')
                                                                <span class="error text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label for="apellidomaterno" class="col-form-label">Apellido Materno</label>
                                                            <input wire:model="apellidomaterno" id="apellidomaterno" onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control" placeholder="Apellido Paterno">
                                                            @error('apellidomaterno')
                                                                <span class="error text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label for="email" class="col-form-label">Email</label>
                                                            <input wire:model="email" id="email" type="text" class="form-control" placeholder="Correo electronico">
                                                            @error('email')
                                                                <span class="error text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="celular" class="col-form-label">Celular</label>
                                                            <input wire:model="celular" id="celular" type="text" class="form-control" placeholder="Celular">
                                                            @error('celular')
                                                                <span class="error text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-vehiculo-update" role="tabpanel" aria-labelledby="custom-tabs-vehiculo-update-tab" wire:ignore.self>

                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    <label for="vin" class="col-form-label">VIN</label>
                                                    <input wire:model="vin" id="vin" onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control" placeholder="VIN">
                                                    @error('vin')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="matricula" class="col-form-label">Matricula</label>
                                                    <input wire:model="matricula" id="matricula" onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control" placeholder="Matricula">
                                                    @error('matricula')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="marca_id" class="col-form-label">Marca</label>
                                                    <select wire:model.ignore="marca_id" class="form-control" id="marca_id" placeholder="Seleccione Marca">
                                                        <option value="">-- Seleccione --</option>
                                                        @foreach ($marcas as $marca)
                                                            <option value="{{$marca->id}}"
                                                                @if (!empty($marca_id) && $marca_id == $marca->id)
                                                                    selected
                                                                @endif
                                                            >{{$marca->marca}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    <label for="familia" class="col-form-label">Familia</label>
                                                    <input wire:model="familia" id="familia" onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control" placeholder="Familia">
                                                    @error('familia')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="modelo" class="col-form-label">Modelo</label>
                                                    <input wire:model="modelo" id="modelo" onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control" placeholder="Modelo">
                                                    @error('modelo')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="color" class="col-form-label">Color</label>
                                                    <input wire:model="color" id="color" onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control" placeholder="BLANCO">
                                                    @error('color')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    <label for="anio" class="col-form-label">Año</label>
                                                    <input wire:model="anio" id="anio" type="text" class="form-control" placeholder="2021">
                                                    @error('anio')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cerrar</button>
                                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-save"></i> Guardar</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
