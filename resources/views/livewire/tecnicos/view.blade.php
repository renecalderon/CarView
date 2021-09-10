@section('title', __('Reparaciones'))
<div class="container-fluid">
	<div class="row justify-content-left">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">

                        <div wire:poll.60s>
							<code><h5>{{ now()->format('j M, g:i a') }}</h5></code>
						</div>

                        @if (session()->has('message'))
                            <div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
                        @endif

						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar">
						</div>
					</div>
				</div>

                <div class="card-body">
					@include('livewire.tecnicos.update')

                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead class="thead">
                                <tr>
                                    <th class='align-middle'>Ref</th>
                                    <th class='align-middle'>Cliente</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reparaciones as $row)
                                    @if (!empty($row->referencia))
                                        <tr>
                                            <td class='align-middle'>{{ $row->referencia }}</td>
                                            <td class='align-middle'>
                                                {{ $row->vehiculo->cliente->nombre ?? ''}}
                                                {{ $row->vehiculo->cliente->apellidopaterno ?? ''}}
                                            </td>
                                            <td class='align-middle' width="30">
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateModal" wire:click="edit({{$row->id}})">
                                                    <i class="fa fa-pen"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
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
