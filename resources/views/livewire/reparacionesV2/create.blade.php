<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Reparacione</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
				<form>
            <div class="form-group">
                <label for="referencia"></label>
                <input wire:model="referencia" type="text" class="form-control" id="referencia" placeholder="Referencia">@error('referencia') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="descripcion"></label>
                <input wire:model="descripcion" type="text" class="form-control" id="descripcion" placeholder="Descripcion">@error('descripcion') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="fechacita"></label>
                <input wire:model="fechacita" type="text" class="form-control" id="fechacita" placeholder="Fechacita">@error('fechacita') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="tiempoestimado"></label>
                <input wire:model="tiempoestimado" type="text" class="form-control" id="tiempoestimado" placeholder="Tiempoestimado">@error('tiempoestimado') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="fechaingreso"></label>
                <input wire:model="fechaingreso" type="text" class="form-control" id="fechaingreso" placeholder="Fechaingreso">@error('fechaingreso') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="fechafin"></label>
                <input wire:model="fechafin" type="text" class="form-control" id="fechafin" placeholder="Fechafin">@error('fechafin') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="fechaentrega"></label>
                <input wire:model="fechaentrega" type="text" class="form-control" id="fechaentrega" placeholder="Fechaentrega">@error('fechaentrega') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="codigodmsasesorservicio"></label>
                <input wire:model="codigodmsasesorservicio" type="text" class="form-control" id="codigodmsasesorservicio" placeholder="Codigodmsasesorservicio">@error('codigodmsasesorservicio') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="codigodmsoperadortecnico"></label>
                <input wire:model="codigodmsoperadortecnico" type="text" class="form-control" id="codigodmsoperadortecnico" placeholder="Codigodmsoperadortecnico">@error('codigodmsoperadortecnico') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="matriculatemporal"></label>
                <input wire:model="matriculatemporal" type="text" class="form-control" id="matriculatemporal" placeholder="Matriculatemporal">@error('matriculatemporal') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="user_id"></label>
                <input wire:model="user_id" type="text" class="form-control" id="user_id" placeholder="User Id">@error('user_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="situacion_id"></label>
                <input wire:model="situacion_id" type="text" class="form-control" id="situacion_id" placeholder="Situacion Id">@error('situacion_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="vehiculo_id"></label>
                <input wire:model="vehiculo_id" type="text" class="form-control" id="vehiculo_id" placeholder="Vehiculo Id">@error('vehiculo_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="taller_id"></label>
                <input wire:model="taller_id" type="text" class="form-control" id="taller_id" placeholder="Taller Id">@error('taller_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="tipo_id"></label>
                <input wire:model="tipo_id" type="text" class="form-control" id="tipo_id" placeholder="Tipo Id">@error('tipo_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Save</button>
            </div>
        </div>
    </div>
</div>