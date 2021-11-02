@section('title', __('Reparaciones'))
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
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-plus"></i>  Agregar nueva
						</div>
					</div>
				</div>

				<div class="card-body">
                    @include('livewire.reparaciones.create')
                    @include('livewire.reparaciones.update')
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
                                    <td class='align-middle'>{{ $loop->iteration }}</td>
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
                                    <td class='align-middle text-center' width="90">
                                        @if (empty($reparacion->referencia) && !empty($reparacion->matriculatemporal) )
                                            <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Editar</button>
                                        @else
                                            <button wire:click="edit({{$reparacion->id}})" data-toggle="modal" data-target="#updateModal" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Editar</button>
                                        @endif
                                    </td>
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
