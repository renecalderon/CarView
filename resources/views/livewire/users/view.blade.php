@section('title', __('Users'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-users text-info"></i>
							Lista de Usuarios </h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('Y-m-d g:i a') }}</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar usuarios">
						</div>
						<div class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#exampleModal">
						<i class="fa fa-plus"></i>  Agregar Usuario
						</div>
					</div>
				</div>

				<div class="card-body">
						@include('livewire.users.create')
						@include('livewire.users.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr>
								<td>#</td>
								<th>Nombre</th>
								<th>Apellido PAterno</th>
								<th>Apellido Materno</th>
								<th>Email</th>
								<th>Sucursal</th>
								<td></td>
							</tr>
						</thead>
						<tbody>
							@foreach($users as $row)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $row->name }}</td>
								<td>{{ $row->apellidopaterno }}</td>
								<td>{{ $row->apellidomaterno }}</td>
								<td>{{ $row->email }}</td>
                                <td>{{ $row->sucursal->nombre }}</td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Acciones
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>
									<a class="dropdown-item" onclick="confirm('Esta seguro de eliminar el usuario {{$row->name}} {{$row->apellidopaterno}} {{$row->apellidomaterno}}? \nEste cambio no se podra deshacer!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Eliminar </a>
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>
					{{ $users->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
