<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear nuevo usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
				<form>

                    <div class="form-group row">
                        <label for="sucursal_id" class="col-sm-4 col-form-label">Agencia</label>
                        <div class="col-sm-8">
                            <select wire:model="sucursal_id" type="text" class="form-control" id="sucursal_id">
                                <option value="">Seleccione Sucursal..</option>
                                @foreach ($sucursales as $sucursal)
                                    <option value="{{$sucursal->id}}">{{$sucursal->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                            @error('sucursal_id')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label">Nombre</label>
                        <div class="col-sm-8">
                            <input wire:model="name" type="text" class="form-control" id="name" placeholder="Nombre">
                        </div>
                        @error('name')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="apellidopaterno" class="col-sm-4 col-form-label">Apellido Paterno</label>
                        <div class="col-sm-8">
                            <input wire:model="apellidopaterno" type="text" class="form-control" id="apellidopaterno" placeholder="Apellido Paterno">
                        </div>
                        @error('apellidopaterno')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="apellidomaterno" class="col-sm-4 col-form-label">Apellido Materno</label>
                        <div class="col-sm-8">
                            <input wire:model="apellidomaterno" type="text" class="form-control" id="apellidomaterno" placeholder="Apellido Materno">
                        </div>
                        @error('apellidomaterno')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input wire:model="email" type="text" class="form-control" id="email" placeholder="Email">
                        </div>
                        @error('email')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input wire:model="password" type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        @error('password')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label">Confirmar Password</label>
                        <div class="col-sm-8">
                            <input wire:model="confirmar_password" type="password" class="form-control" id="password" placeholder="Confirmar password">
                        </div>
                        @error('password')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="codigodms" class="col-sm-4 col-form-label">Codigo DMS</label>
                        <div class="col-sm-8">
                            <input wire:model="codigodms" type="text" class="form-control" id="codigodms" placeholder="Codigo DMS">
                        </div>
                        @error('codigodms')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Guardar</button>
            </div>
        </div>
    </div>
</div>
