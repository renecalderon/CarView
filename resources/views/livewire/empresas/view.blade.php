@section('title', __('Empresas'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-cog text-info"></i> Lista de Empresas</h4>
						</div>
						<div wire:poll.60s>
                            <code><h5>{{ now()->format('j M, g:i a') }}</h5></code>
                        </div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar Empresa">
						</div>
						<div class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#exampleModal">
						<i class="fa fa-plus"></i>  Agregar Empresa
						</div>
					</div>
				</div>

				<div class="card-body">
                    @include('livewire.empresas.create')
                    @include('livewire.empresas.update')
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead">
                                <tr>
                                    <td>#</td>
                                    <th>RFC</th>
                                    <th>RAZON SOCIAL</th>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($empresas as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->rfc }}</td>
                                    <td>{{ $row->razonsocial }}</td>
                                    <td width="90">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Acciones
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                        <a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit </a>
                                        <a class="dropdown-item" onclick="confirm('Confirmar eliminacion de Empresa? \nNo se podra deshacer!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Eliminar </a>
                                        </div>
                                    </div>
                                    </td>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $empresas->links() }}
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
