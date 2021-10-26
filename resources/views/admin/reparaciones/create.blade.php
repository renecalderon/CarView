@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="row">

                    <div class="col-md-7">
                        <form action="{{ route('admin.reparaciones.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            {{-- @method('PUT') --}}

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

                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label for="referencia" class="col-form-label">Referencia</label>
                                                    <input name="referencia" id="referencia" value="" type="text" class="form-control" placeholder="Referencia">
                                                    @error('referencia')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-5">
                                                    <label for="tipo_id" class="col-sm-4 col-form-label">Tipo</label>
                                                    <select name="tipo_id" id="tipo_id" type="text" class="form-control" placeholder="Seleccione Tipo de OR">
                                                        <option value="">-- Seleccione tipo --</option>
                                                        @foreach ($tipos as $tipo)
                                                            <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
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
                                                            <option value="{{$situacion->id}}">{{$situacion->nombre}}</option>
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
                                                            <option value="{{$asesor->codigodmsasesorservicio}}">{{$asesor->name}}</option>
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
                                                            <option value="{{$tecnico->codigodmsoperadortecnico}}">{{$tecnico->name}}</option>
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
                                                    <input name="descripcion" id="descripcion" onkeyup="this.value = this.value.toUpperCase();" value="" type="text" class="form-control" placeholder="Ingrese la descripcion">
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
                                                            <input name="nombre" id="nombre" onkeyup="this.value = this.value.toUpperCase();" value="" type="text" class="form-control" placeholder="Nombre o Razon Social">
                                                            @error('nombre')
                                                                <span class="error text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label for="apellidopaterno" class="col-form-label">Apellido Paterno</label>
                                                            <input name="apellidopaterno" id="apellidopaterno" onkeyup="this.value = this.value.toUpperCase();" value="" type="text" class="form-control" placeholder="Apellido Paterno">
                                                            @error('apellidopaterno')
                                                                <span class="error text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label for="apellidomaterno" class="col-form-label">Apellido Materno</label>
                                                            <input name="apellidomaterno" id="apellidomaterno" onkeyup="this.value = this.value.toUpperCase();" value="" type="text" class="form-control" placeholder="Apellido Paterno">
                                                            @error('apellidomaterno')
                                                                <span class="error text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label for="email" class="col-form-label">Email</label>
                                                            <input name="email" id="email" value="" type="text" class="form-control" placeholder="Correo electronico">
                                                            @error('email')
                                                                <span class="error text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="celular" class="col-form-label">Celular</label>
                                                            <input name="celular" id="celular" value="" type="text" class="form-control" placeholder="Celular">
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
                                                    <input name="vin" id="vin" onkeyup="this.value = this.value.toUpperCase();" value="" type="text" class="form-control" placeholder="VIN">
                                                    @error('vin')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="matricula" class="col-form-label">Matricula</label>
                                                    <input name="matricula" id="matricula" onkeyup="this.value = this.value.toUpperCase();" value="" type="text" class="form-control" placeholder="Matricula">
                                                    @error('matricula')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="marca_id" class="col-form-label">Marca</label>
                                                    <select name="marca_id" class="form-control" id="marca_id" placeholder="Seleccione Marca">
                                                        <option value="">-- Seleccione marca --</option>
                                                        @foreach ($marcas as $marca)
                                                            <option value="{{$marca->id}}">{{$marca->marca}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    <label for="familia" class="col-form-label">Familia</label>
                                                    <input name="familia" id="familia" onkeyup="this.value = this.value.toUpperCase();" value="" type="text" class="form-control" placeholder="Familia">
                                                    @error('familia')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="modelo" class="col-form-label">Modelo</label>
                                                    <input name="modelo" id="modelo" onkeyup="this.value = this.value.toUpperCase();" value="" type="text" class="form-control" placeholder="Modelo">
                                                    @error('modelo')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="color" class="col-form-label">Color</label>
                                                    <input name="color" id="color" onkeyup="this.value = this.value.toUpperCase();" value="" type="text" class="form-control" placeholder="BLANCO">
                                                    @error('color')
                                                        <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    <label for="anio" class="col-form-label">Año</label>
                                                    <input name="anio" id="anio" value="" type="text" class="form-control" placeholder="2021">
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

@stop
