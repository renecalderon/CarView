<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-three-reparacion-tab" data-toggle="pill" href="#custom-tabs-three-reparacion" role="tab" aria-controls="custom-tabs-three-reparacion" aria-selected="true">Orden de Servicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-three-cliente-tab" data-toggle="pill" href="#custom-tabs-three-cliente" role="tab" aria-controls="custom-tabs-three-cliente" aria-selected="false">Cliente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-three-vehiculo-tab" data-toggle="pill" href="#custom-tabs-three-vehiculo" role="tab" aria-controls="custom-tabs-three-vehiculo" aria-selected="false">Vehiculo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-three-propuesta-tab" data-toggle="pill" href="#custom-tabs-three-propuesta" role="tab" aria-controls="custom-tabs-three-propuesta" aria-selected="false">Propuestas</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-three-reparacion" role="tabpanel" aria-labelledby="custom-tabs-three-reparacion-tab">
                        <form>
                            <input type="hidden" wire:model.defer="selected_id">

                            <div class="form-group row">
                                <label for="referencia" class="col-sm-4 col-form-label">Referencia</label>
                                <div class="col-sm-8">
                                    <input wire:model.defer="referencia" type="text" class="form-control" id="referencia" placeholder="Referencia">
                                </div>
                                @error('referencia')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="descripcion" class="col-sm-4 col-form-label">Descripción</label>
                                <div class="col-sm-8">
                                    <textarea wire:model.defer="descripcion" class="form-control" rows="2" placeholder="Descripcion de la Orden de Servicio"></textarea>
                                </div>
                                @error('descripcion')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="tipo_id" class="col-sm-4 col-form-label">Tipo</label>
                                <div class="col-sm-8">
                                    <select wire:model.defer="tipo_id" type="text" class="form-control" id="tipo_id" placeholder="Seleccione Tipo de OR">
                                        @foreach ($tipos as $tipo)
                                            <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                    @error('tipo_id')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                            </div>

                            <div class="form-group row">
                                <label for="estado_id" class="col-sm-4 col-form-label">Estado</label>
                                <div class="col-sm-8">
                                    <select wire:model.defer="estado_id" type="text" class="form-control" id="estado_id" placeholder="Estado">
                                        @foreach ($estados as $estado)
                                            <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                    @error('estado_id')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                            </div>

                            @if(!empty($comentarios) && $comentarios->count())
                                <div class="card card-primary card-outline direct-chat direct-chat-primary">
                                    <div class="direct-chat-messages">
                                        @foreach ($comentarios as $comentario)
                                            <div class="direct-chat-msg right">
                                                <div class="direct-chat-infos clearfix">
                                                    <span class="direct-chat-name float-right">Rene Caderon</span>
                                                    <span class="direct-chat-timestamp float-left">{{ \Carbon\Carbon::parse($comentario->created_at)->format('j M, g:i a')}}</span>
                                                </div>
                                                {{-- <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="image"> --}}
                                                <img class="direct-chat-img" src="vendor/adminlte/dist/img/logo.png" alt="image">
                                                <div class="direct-chat-text">
                                                    {{$comentario->comentario}}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif


                        </form>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-cliente" role="tabpanel" aria-labelledby="custom-tabs-three-cliente-tab">
                        <form>
                            <input type="hidden" wire:model.defer="selected_id">
                            <div class="form-group row">
                                <label for="nombre" class="col-sm-4 col-form-label">Nombre</label>
                                <div class="col-sm-8">
                                    <input wire:model.defer="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre o Razon Social">
                                </div>
                                @error('nombre')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="apellidopaterno" class="col-sm-4 col-form-label">Apellido Paterno</label>
                                <div class="col-sm-8">
                                    <input wire:model.defer="apellidopaterno" type="text" class="form-control" id="apellidopaterno" placeholder="Apellido Paterno">
                                </div>
                                @error('apellidopaterno')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="apellidomaterno" class="col-sm-4 col-form-label">Apellido Materno</label>
                                <div class="col-sm-8">
                                    <input wire:model.defer="apellidomaterno" type="text" class="form-control" id="apellidomaterno" placeholder="Apellido Materno">
                                </div>
                                @error('apellidomaterno')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input wire:model.defer="email" type="text" class="form-control" id="email" placeholder="Correo electronico">
                                </div>
                                @error('email')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="celular" class="col-sm-4 col-form-label">Celular</label>
                                <div class="col-sm-8">
                                    <input wire:model.defer="celular" type="text" class="form-control" id="celular" placeholder="Celular">
                                </div>
                                @error('celular')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="codigodmsasesorservicio" class="col-sm-4 col-form-label">Asesor asignado</label>
                                <div class="col-sm-8">
                                    <select wire:model.defer="codigodmsasesorservicio" type="text" class="form-control" id="codigodmsasesorservicio" placeholder="Seleccione Asesor">
                                        @foreach ($asesores as $asesor)
                                            <option value="{{$asesor->codigodmsasesorservicio}}">{{$asesor->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('codigodmsasesorservicio')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="codigodmsoperadortecnico" class="col-sm-4 col-form-label">Tecnico asignado</label>
                                <div class="col-sm-8">
                                    <select wire:model.defer="codigodmsoperadortecnico" type="text" class="form-control" id="codigodmsoperadortecnico" placeholder="Seleccione Tecnico">
                                        @foreach ($tecnicos as $tecnico)
                                            <option value="{{$tecnico->codigodmsoperadortecnico}}">{{$tecnico->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('codigodmsoperadortecnico')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </form>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-vehiculo" role="tabpanel" aria-labelledby="custom-tabs-three-vehiculo-tab">
                        <form>
                            <input type="hidden" wire:model.defer="selected_id">

                            <div class="form-group row">
                                <label for="vin" class="col-sm-4 col-form-label">VIN</label>
                                <div class="col-sm-8">
                                    <input wire:model.defer="vin" type="text" class="form-control" id="vin" placeholder="VIN">
                                </div>
                                @error('vin')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="matricula" class="col-sm-4 col-form-label">Matricula</label>
                                <div class="col-sm-8">
                                    <input wire:model.defer="matricula" type="text" class="form-control" id="matricula" placeholder="Matricula">
                                </div>
                                @error('matricula')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="marca_id" class="col-sm-4 col-form-label">Marca</label>
                                <div class="col-sm-8">
                                    <select wire:model.defer="marca_id" type="text" class="form-control" id="marca_id" placeholder="Seleccione Marca">
                                        @foreach ($marcas as $marca)
                                            <option value="{{$marca->id}}">{{$marca->marca}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                    @error('marca_id')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                            </div>

                            <div class="form-group row">
                                <label for="familia" class="col-sm-4 col-form-label">Familia</label>
                                <div class="col-sm-8">
                                    <input wire:model.defer="familia" type="text" class="form-control" id="familia" placeholder="Familia">
                                </div>
                                @error('familia')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="modelo" class="col-sm-4 col-form-label">Modelo</label>
                                <div class="col-sm-8">
                                    <input wire:model.defer="modelo" type="text" class="form-control" id="modelo" placeholder="Modelo">
                                </div>
                                @error('modelo')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="color" class="col-sm-4 col-form-label">Color</label>
                                <div class="col-sm-8">
                                    <input wire:model.defer="color" type="text" class="form-control" id="color" placeholder="Color">
                                </div>
                                @error('color')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="anio" class="col-sm-4 col-form-label">Año</label>
                                <div class="col-sm-8">
                                    <input wire:model.defer="anio" type="text" class="form-control" id="anio" placeholder="Año">
                                </div>
                                @error('anio')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </form>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-propuesta" role="tabpanel" aria-labelledby="custom-tabs-three-propuesta-tab">
                        Informacion de Propuestas
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Guardar</button>
            </div>
        </div>
    </div>
</div>
