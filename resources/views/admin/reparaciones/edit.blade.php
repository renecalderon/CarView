@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-5">

                        <!-- Timelime example  -->
                        <div class="row">
                            <div class="col-md-12">
                            <!-- The time line -->
                            <div class="timeline">
                                <!-- timeline time label -->
                                <div class="time-label">
                                <span class="bg-red">10 Feb. 2014</span>
                                </div>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <div>
                                <i class="fas fa-envelope bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                                    <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                    <div class="timeline-body">
                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                    weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                    quora plaxo ideeli hulu weebly balihoo...
                                    </div>
                                    <div class="timeline-footer">
                                    <a class="btn btn-primary btn-sm">Read more</a>
                                    <a class="btn btn-danger btn-sm">Delete</a>
                                    </div>
                                </div>
                                </div>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <div>
                                <i class="fas fa-user bg-green"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>
                                    <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
                                </div>
                                </div>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <div>
                                <i class="fas fa-comments bg-yellow"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                                    <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                                    <div class="timeline-body">
                                    Take me to your leader!
                                    Switzerland is small and neutral!
                                    We are more like Germany, ambitious and misunderstood!
                                    </div>
                                    <div class="timeline-footer">
                                    <a class="btn btn-warning btn-sm">View comment</a>
                                    </div>
                                </div>
                                </div>
                                <!-- END timeline item -->
                                <!-- timeline time label -->
                                <div class="time-label">
                                <span class="bg-green">3 Jan. 2014</span>
                                </div>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <div>
                                <i class="fa fa-camera bg-purple"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> 2 days ago</span>
                                    <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                                    <div class="timeline-body">
                                    <img src="https://placehold.it/150x100" alt="...">
                                    <img src="https://placehold.it/150x100" alt="...">
                                    <img src="https://placehold.it/150x100" alt="...">
                                    <img src="https://placehold.it/150x100" alt="...">
                                    <img src="https://placehold.it/150x100" alt="...">
                                    </div>
                                </div>
                                </div>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <div>
                                <i class="fas fa-video bg-maroon"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> 5 days ago</span>

                                    <h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>

                                    <div class="timeline-body">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tMWkeBIohBs" allowfullscreen></iframe>
                                    </div>
                                    </div>
                                    <div class="timeline-footer">
                                    <a href="#" class="btn btn-sm bg-maroon">See comments</a>
                                    </div>
                                </div>
                                </div>
                                <!-- END timeline item -->
                                <div>
                                <i class="fas fa-clock bg-gray"></i>
                                </div>
                            </div>
                            </div>
                            <!-- /.col -->
                        </div>

                    </div>

                    <div class="col-md-7">
                        <form action="{{ route('admin.reparaciones.update', $reparacion->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('PUT')

                            {{-- @if ($propuestas->count() >= 1) --}}
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                            <h3 class="card-title">
                                                <i class="fas fa-tools text-danger"></i> Propuestas
                                            </h3>
                                            <div class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal">
                                                <i class="fa fa-plus"></i>  Importar Propuesta
                                            </div>
                                        </div>
                                    </div>
                                    @if ($propuestas->count() >= 1)
                                    <div class="card-body">

                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th class="align-middle text-center"><i class="fas fa-cogs"></i></th>
                                                    <th class="align-middle text-left">Propuesta</th>
                                                    <th class="align-middle text-center"><i class="fa fa-traffic-light"></i></th>
                                                    <th class="align-middle text-right"><i class="fa fa-dollar-sign"></i> Refaccion</th>
                                                    <th class="align-middle text-center"><i class="fa fa-dollar-sign"></i> Taller</th>
                                                    <th class="align-middle text-right"><i class="fa fa-dollar-sign"></i> Total</th>
                                                    <th class="align-middle text-center"><i class="fa fa-handshake"></i></th>
                                                    <th class="align-middle text-center">Autorizacion</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($propuestas as $propuesta)
                                                    <tr>
                                                        <td class="align-middle text-center"><a href="{{url($propuesta->path)}}" target="_blank"><i class="fas fa-file-pdf"></i></a></td>
                                                        <td class="align-middle">{{$propuesta->nombre_propuesta}}</td>
                                                        <td class="align-middle text-center">
                                                            @foreach ($semaforos as $semaforo)
                                                                @if ($propuesta->semaforo_id == $semaforo->id)
                                                                    <i class="nav-icon fas fa-record-vinyl fa-1x text-{{$semaforo->colorname}}" title="{{$semaforo->nombre}}"></i>
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td class="align-middle text-right">{{number_format($propuesta->total, 2, '.', ',')}}</td>
                                                        <td class="align-middle text-right" width="120">
                                                            <input name="manodeobra[{{$propuesta->id}}]" id="manodeobra[{{$propuesta->id}}]" value="{{number_format($propuesta->manodeobra, 2, '.', ',')}}" type="text" step="0.01" class="form-control" placeholder="19,000.00">
                                                        </td>
                                                        <td class="align-middle text-right">
                                                            {{number_format($propuesta->total+$propuesta->manodeobra, 2, '.', ',')}}
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            @foreach ($estados as $estado)
                                                                @if ($propuesta->estado_id == $estado->id)
                                                                    <i class="nav-icon fas fa-bullseye fa-2x text-{{$estado->colorname}}" title="{{$estado->nombre}}"></i>
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <select name="status[{{$propuesta->id}}]" id="status[{{$propuesta->id}}]" type="text" class="form-control">
                                                                <option value="" hidden>Pendiente</option>
                                                                @foreach ($estados as $estado)
                                                                    <option value="{{$estado->id}}"
                                                                        @if ($propuesta->estado_id == $estado->id)
                                                                            selected
                                                                        @endif
                                                                        >{{$estado->nombre}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                    @endif
                                </div>
                            {{-- @endif --}}

                            <div class="card card-primary card-outline card-outline-tabs">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-reparacion-tab" data-toggle="pill" href="#custom-tabs-reparacion" role="tab" aria-controls="custom-tabs-reparacion" aria-selected="true"><i class="fas fa-grip-vertical text-danger"></i> Referencia</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-cliente-tab" data-toggle="pill" href="#custom-tabs-cliente" role="tab" aria-controls="custom-tabs-cliente" aria-selected="false"><i class="fas fa-user text-danger"></i> Cliente</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-vehiculo-tab" data-toggle="pill" href="#custom-tabs-vehiculo" role="tab" aria-controls="custom-tabs-vehiculo" aria-selected="false"><i class="fas fa-car text-danger"></i> Vehiculo</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">

                                    <div class="tab-content" id="custom-tabs-tabContent">
                                        <div class="tab-pane fade show active" id="custom-tabs-reparacion" role="tabpanel" aria-labelledby="custom-tabs-reparacion-tab">
                                            <input type="hidden" id="{{$reparacion->id}}">
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label for="referencia" class="col-form-label">Referencia</label>
                                                    <input name="referencia" id="referencia" value="{{$reparacion->referencia}}" type="text" class="form-control" placeholder="Referencia">
                                                    @error('referencia')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-5">
                                                    <label for="tipo_id" class="col-sm-4 col-form-label">Tipo</label>
                                                    <select name="tipo_id" id="tipo_id" type="text" class="form-control" placeholder="Seleccione Tipo de OR">
                                                        <option value="">-- Seleccione tipo --</option>
                                                        @foreach ($tipos as $tipo)
                                                            <option value="{{$tipo->id}}"
                                                            @if ($reparacion->tipo_id == $tipo->id)
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
                                                    <select name="situacion_id" type="text" class="form-control" id="situacion_id" placeholder="Estado">
                                                        <option value="">-- Seleccione estado --</option>
                                                        @foreach ($situaciones as $situacion)
                                                            <option value="{{$situacion->id}}"
                                                            @if ($reparacion->situacion_id == $situacion->id)
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
                                                    <select name="codigodmsasesorservicio" class="form-control" id="codigodmsasesorservicio" placeholder="Seleccione Asesor">
                                                        <option value=""> -- Seleccione asesor -- </option>
                                                        @foreach ($asesores as $asesor)
                                                            <option value="{{$asesor->codigodmsasesorservicio}}"
                                                            @if ($reparacion->codigodmsasesorservicio == $asesor->codigodmsasesorservicio)
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
                                                    <select name="codigodmsoperadortecnico" class="form-control" id="codigodmsoperadortecnico" placeholder="Seleccione Tecnico">
                                                        <option value=""> -- Seleccione tecnico -- </option>
                                                        @foreach ($tecnicos as $tecnico)
                                                            <option value="{{$tecnico->codigodmsoperadortecnico}}"
                                                            @if ($reparacion->codigodmsoperadortecnico == $tecnico->codigodmsoperadortecnico)
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
                                                    <input name="descripcion" id="descripcion" onkeyup="this.value = this.value.toUpperCase();" value="{{$reparacion->descripcion}}" type="text" class="form-control" placeholder="Ingrese la descripcion">
                                                    @error('descripcion')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-cliente" role="tabpanel" aria-labelledby="custom-tabs-cliente-tab">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label for="nombre" class="col-form-label">Nombre</label>
                                                            <input name="nombre" id="nombre" onkeyup="this.value = this.value.toUpperCase();" value="{{$reparacion->vehiculo->cliente->nombre ?? ''}}" type="text" class="form-control" placeholder="Nombre o Razon Social">
                                                            @error('nombre')
                                                                <span class="error text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label for="apellidopaterno" class="col-form-label">Apellido Paterno</label>
                                                            <input name="apellidopaterno" id="apellidopaterno" onkeyup="this.value = this.value.toUpperCase();" value="{{$reparacion->vehiculo->cliente->apellidopaterno ?? ''}}" type="text" class="form-control" placeholder="Apellido Paterno">
                                                            @error('apellidopaterno')
                                                                <span class="error text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label for="apellidomaterno" class="col-form-label">Apellido Materno</label>
                                                            <input name="apellidomaterno" id="apellidomaterno" onkeyup="this.value = this.value.toUpperCase();" value="{{$reparacion->vehiculo->cliente->apellidomaterno ?? ''}}" type="text" class="form-control" placeholder="Apellido Paterno">
                                                            @error('apellidomaterno')
                                                                <span class="error text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label for="email" class="col-form-label">Email</label>
                                                            <input name="email" id="email" value="{{$reparacion->vehiculo->cliente->email ?? ''}}" type="text" class="form-control" placeholder="Correo electronico">
                                                            @error('email')
                                                                <span class="error text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="celular" class="col-form-label">Celular</label>
                                                            <input name="celular" id="celular" value="{{$reparacion->vehiculo->cliente->celular ?? ''}}" type="text" class="form-control" placeholder="Celular">
                                                            @error('celular')
                                                                <span class="error text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-vehiculo" role="tabpanel" aria-labelledby="custom-tabs-vehiculo-tab">
                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    <label for="vin" class="col-form-label">VIN</label>
                                                    <input name="vin" id="vin" onkeyup="this.value = this.value.toUpperCase();" value="{{$reparacion->vehiculo->vin ?? ''}}" type="text" class="form-control" placeholder="VIN">
                                                    @error('vin')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="matricula" class="col-form-label">Matricula</label>
                                                    <input name="matricula" id="matricula" onkeyup="this.value = this.value.toUpperCase();" value="{{$reparacion->vehiculo->matricula ?? ''}}" type="text" class="form-control" placeholder="Matricula">
                                                    @error('matricula')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="marca_id" class="col-form-label">Marca</label>
                                                    <select name="marca_id" class="form-control" id="marca_id" placeholder="Seleccione Marca">
                                                        <option value="">-- Seleccione marca --</option>
                                                        @foreach ($marcas as $marca)
                                                            <option value="{{$marca->id}}"
                                                                @if (!empty($reparacion->vehiculo->marca_id) && $reparacion->vehiculo->marca_id == $marca->id)
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
                                                    <input name="familia" id="familia" onkeyup="this.value = this.value.toUpperCase();" value="{{$reparacion->vehiculo->familia ?? ''}}" type="text" class="form-control" placeholder="Familia">
                                                    @error('familia')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="modelo" class="col-form-label">Modelo</label>
                                                    <input name="modelo" id="modelo" onkeyup="this.value = this.value.toUpperCase();" value="{{$reparacion->vehiculo->modelo ?? ''}}" type="text" class="form-control" placeholder="Modelo">
                                                    @error('modelo')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="color" class="col-form-label">Color</label>
                                                    <input name="color" id="color" onkeyup="this.value = this.value.toUpperCase();" value="{{$reparacion->vehiculo->color ?? ''}}" type="text" class="form-control" placeholder="BLANCO">
                                                    @error('color')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    <label for="anio" class="col-form-label">Año</label>
                                                    <input name="anio" id="anio" value="{{$reparacion->vehiculo->anio ?? ''}}" type="text" class="form-control" placeholder="2021">
                                                    @error('anio')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    {!! link_to('reparaciones', ' Cerrar', ['class' => 'btn btn-default btn-close fa fa-times-circle float-right']) !!}
                                    <button type="submit" class="flex float-right btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                                </div>

                            </div>
                        </form>

                    </div>

                </div>

            </div>
        </div>


    </div>
@stop

@section('css')

@stop

@section('js')
    <script type="text/javascript">
        window.livewire.on('closeModal', () => {
            $('#exampleModal').modal('hide');
        });
    </script>
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@stop
