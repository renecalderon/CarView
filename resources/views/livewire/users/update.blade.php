<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">

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
                        <label for="codigodmsasesorservicio" class="col-sm-4 col-form-label">Codigo DMS de Asesor de Servicio</label>
                        <div class="col-sm-8">
                            <input wire:model="codigodmsasesorservicio" type="text" class="form-control" id="codigodmsasesorservicio" placeholder="Codigo DMS">
                        </div>
                        @error('codigodmsasesorservicio')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="codigodmsoperadortecnico" class="col-sm-4 col-form-label">Codigo DMS de Operador Tecnico</label>
                        <div class="col-sm-8">
                            <input wire:model="codigodmsoperadortecnico" type="text" class="form-control" id="codigodmsoperadortecnico" placeholder="Codigo DMS">
                        </div>
                        @error('codigodmsoperadortecnico')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>



                    <div class="form-group row">
                        <label for="roles" class="col-sm-4 col-form-label">Permisos</label>
                        <div class="col-sm-8">

                            @foreach ($roles as $role)
                                <div class="form-check">
                                    <input name="nuevosRoles[]" class="form-check-input" type="checkbox" value="{{$role->id}}" id="{{$role->id}}"
                                        @if (!empty($userRoles))
                                            @foreach ($userRoles as $userRole)
                                                @if ($role->name == $userRole)
                                                    checked
                                                @endif
                                            @endforeach
                                        @endif
                                    />
                                    <label class="form-check-label" for="{{$role->id}}">{{$role->name}}</label>
                                </div>
                            @endforeach

                        </div>
                            @error('roles')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Guardar</button>
            </div>
        </div>
    </div>
</div>
