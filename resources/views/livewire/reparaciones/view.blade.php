<div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div class="float-left">
                                <h4><i class="fas fa-tools text-info"></i>
                                Ordenes de Servicio </h4>
                            </div>
                            <div wire:poll.60s>
                                <code><h5>{{ now()->format('j M, g:i a') }}</h5></code>
                            </div>
                            @if (session()->has('message'))
                                <div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
                            @endif
                            <div>
                                <input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar dato">
                            </div>
                            <div>
                                <a href="{{route('admin.reparaciones.create')}}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Orden Nueva</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead class="thead">
                                    <tr>
                                        <td class='align-middle'>#</td>
                                        <th class='align-middle'>Referencia</th>
                                        <th class='align-middle'>Cliente</th>
                                        <th class='align-middle'>Familia</th>
                                        <th class='align-middle'>Matricula</th>
                                        <th class='align-middle'>Descripcion</th>
                                        <th class='align-middle'>Fecha Cita</th>
                                        <th class='align-middle'>Fecha Ingreso</th>
                                        <th class='align-middle'>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reparaciones as $reparacion)
                                        <tr>
                                            <td class='align-middle'>{{ $loop->iteration }} {{$reparacion->id}}</td>
                                            <td class='align-middle'>{{ $reparacion->referencia }}</td>
                                            <td class='align-middle'>
                                                {{ $reparacion->vehiculo->cliente->nombre ?? ''}}
                                                {{ $reparacion->vehiculo->cliente->apellidopaterno ?? ''}}
                                                {{ $reparacion->vehiculo->cliente->apellidomaterno ?? ''}}
                                            </td>
                                            <td class='align-middle'>{{ $reparacion->vehiculo->familia ?? ''}}</td>
                                            <td class='align-middle'>
                                                @if (!empty($reparacion->vehiculo->matricula))
                                                    {{ $reparacion->vehiculo->matricula}}
                                                @else
                                                    {{$reparacion->matriculatemporal}}
                                                @endif
                                            </td>
                                            <td class='align-middle'>{{ $reparacion->descripcion }}</td>
                                            <td class='align-middle'>{{ $reparacion->fechacita ?? ''}}</td>
                                            <td class='align-middle'>{{ $reparacion->fechaingreso }}</td>
                                            <td class='align-middle text-center'>
                                                {{ $reparacion->situacion->nombre ?? '' }}
                                            </td>
                                            <td class='align-middle' width="90">
                                                @if (empty($reparacion->referencia) && !empty($reparacion->matriculatemporal) )
                                                    <a href="{{route('admin.reparaciones.edit', $reparacion->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-edit"></i> Editar</a>
                                                @else
                                                    <a href="{{route('admin.reparaciones.edit', $reparacion->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Editar</a>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $reparaciones->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
