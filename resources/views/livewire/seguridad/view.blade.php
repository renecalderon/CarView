@section('title', __('Reparaciones'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: center; align-items: center;">
						<div wire:poll.60s>
							<code><h5>{{ now()->format('Y-m-d g:i a') }}</h5></code>
						</div>
					</div>
				</div>

                <div class="card-body">
                    @if (session()->has('message'))
						<div wire:poll.20s class="btn btn-lg btn-block btn-success" style="margin-top:10px; margin-bottom:10px;"> {{ session('message') }} </div>
					@endif

                    <form wire:submit.prevent="submit">
                        <div class="form-group">
                            <input type="text" class="form-control text-center" id="matricula" placeholder="Ingrese matricula" wire:model="matricula" autocomplete="off">
                            @error('matricula') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-lg btn-block btn-primary"><i class="fas fa-shield-alt"></i> Registrar Cita</button>
                    </form>
                </div>
			</div>
		</div>
	</div>
</div>
