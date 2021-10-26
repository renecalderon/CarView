@section('title', __('Reparaciones'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							Reparacione Listing </h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Reparaciones">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal">
						<i class="fa fa-plus"></i>  Add Reparaciones
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
								<td>#</td> 
								<th>Referencia</th>
								<th>Descripcion</th>
								<th>Fechacita</th>
								<th>Tiempoestimado</th>
								<th>Fechaingreso</th>
								<th>Fechafin</th>
								<th>Fechaentrega</th>
								<th>Codigodmsasesorservicio</th>
								<th>Codigodmsoperadortecnico</th>
								<th>Matriculatemporal</th>
								<th>User Id</th>
								<th>Situacion Id</th>
								<th>Vehiculo Id</th>
								<th>Taller Id</th>
								<th>Tipo Id</th>
								<td>ACTIONS</td>
							</tr>
						</thead>
						<tbody>
							@foreach($reparaciones as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->referencia }}</td>
								<td>{{ $row->descripcion }}</td>
								<td>{{ $row->fechacita }}</td>
								<td>{{ $row->tiempoestimado }}</td>
								<td>{{ $row->fechaingreso }}</td>
								<td>{{ $row->fechafin }}</td>
								<td>{{ $row->fechaentrega }}</td>
								<td>{{ $row->codigodmsasesorservicio }}</td>
								<td>{{ $row->codigodmsoperadortecnico }}</td>
								<td>{{ $row->matriculatemporal }}</td>
								<td>{{ $row->user_id }}</td>
								<td>{{ $row->situacion_id }}</td>
								<td>{{ $row->vehiculo_id }}</td>
								<td>{{ $row->taller_id }}</td>
								<td>{{ $row->tipo_id }}</td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Actions
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit </a>							 
									<a class="dropdown-item" onclick="confirm('Confirm Delete Reparacione id {{$row->id}}? \nDeleted Reparaciones cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Delete </a>   
									</div>
								</div>
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