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
					</div>
				</div>

				<div class="card-body">
                    @include('livewire.reparaciones.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr>
								<td class='align-middle'>#</td>
								<th class='align-middle'>Referencia</th>
                                <th class='align-middle'>Cliente</th>
                                <th class='align-middle'>Modelo</th>
                                <th class='align-middle'>Matricula</th>
								<th class='align-middle'>Descripcion</th>
                                <th class='align-middle'>Fecha Cita</th>
								<th class='align-middle'>Fecha Ingreso</th>
                                <th class='align-middle'>Estado</th>
                                <th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($reparaciones as $row)

                                <tr>
                                    <td class='align-middle'>{{ $loop->iteration }}</td>
                                    <td class='align-middle'>{{ $row->referencia }}</td>
                                    <td class='align-middle'>
                                        {{ $row->vehiculo->cliente->nombre ?? ''}}
                                        {{ $row->vehiculo->cliente->apellidopaterno ?? ''}}
                                        {{ $row->vehiculo->cliente->apellidomaterno ?? ''}}
                                    </td>
                                    <td class='align-middle'>{{ $row->vehiculo->modelo ?? ''}}</td>
                                    <td class='align-middle'>{{ $row->vehiculo->matricula ?? ''}}</td>
                                    <td class='align-middle'>{{ $row->descripcion }}</td>
                                    <td class='align-middle'>{{ $row->fechacita ?? ''}}</td>
                                    <td class='align-middle'>{{ $row->fechaingreso }}</td>
                                    <td class='align-middle text-center'>
                                        {{ $row->estado->nombre ?? '' }}
                                    </td>
                                    <td class='align-middle' width="90">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateModal" wire:click="edit({{$row->id}})">
                                            <i class="fa fa-edit"> Editar</i>
                                        </button>
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
