@section('title', __('Reparaciones'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-user-clock text-info"></i>
							Lista de Citas </h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('Y-m-d g:i a') }}</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar cita">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal">
						<i class="fa fa-plus"></i>  Importar Citas
						</div>
					</div>
				</div>

				<div class="card-body">
						@include('livewire.citas.create')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr>
								<td>#</td>
								<th>Referencia</th>
                                <th>Cliente</th>
                                <th>Celular</th>
                                <th>Modelo</th>
								<th>Descripcion</th>
								<th>Fecha Cita</th>
								<th>Fecha Ingreso</th>
                                <th>Estado</th>
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
								<td class='align-middle'>{{ $row->vehiculo->cliente->celular ?? ''}}</td>
                                <td class='align-middle'>{{ $row->vehiculo->modelo ?? ''}}</td>
                                <td class='align-middle'>{{ $row->descripcion }}</td>
								<td class='align-middle'>{{ $row->fechacita ?? ''}}</td>
								<td>{{ $row->fechaingreso }}</td>
                                <td class='align-middle text-center'>
                                    @if ( !empty($row->fechaingreso) )
                                        <span class="badge badge-success">Ha llegado</span>
                                    @elseif ( strtotime(now()->format('Y-m-d H:i:s ')) > strtotime('+15 minute', strtotime($row->fechacita)) )
                                        <span class="badge badge-danger">Con retraso</span>
                                    @else
                                        <span class="badge badge-warning">Pendiente</span>
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
