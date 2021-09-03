@section('title', __('Sucursales'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-cogs text-info"></i> Lista de Sucursales</h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('Y-m-d g:i a') }}</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar Sucursal">
						</div>
						<div class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#exampleModal">
						<i class="fa fa-plus"></i>  Agregar Sucursal
						</div>
					</div>
				</div>

				<div class="card-body">
						@include('livewire.sucursales.create')
						@include('livewire.sucursales.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr>
								<td>#</td>
                                <th>Agencia</th>
                                <th>Empresa</th>
								<th>Direccion</th>
								<th>Pagina</th>
								<th>Telefono</th>
								<td></td>
							</tr>
						</thead>
						<tbody>
							@foreach($sucursales as $row)
							<tr>
								<td>{{ $loop->iteration }}</td>
                                <td>{{ $row->nombre }}</td>
                                <td>{{ $row->empresa->razonsocial }}</td>
								<td>{{ $row->direccion }}</td>
								<td>{{ $row->pagina }}</td>
								<td>{{ $row->telefono }}</td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Acciones
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>
									<a class="dropdown-item" onclick="confirm('Esta seguro de eliminar la Sucursal {{$row->name}}? \nEste cambio no se puede deshacer!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Eliminar </a>
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>
					{{ $sucursales->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
