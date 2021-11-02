<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar propuestas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="card-body">
                <div class="card bg-light d-flex flex-fill">
                    <div class="card-header text-muted border-bottom-0">
                        <h6><code>{{$estado ?? ''}}</code></h6>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-9">
                                <h5><b><code>{{$referencia}}</code></b></h5>
                                <h5 class="lead">{{$nombre}} {{$apellidopaterno}} {{$apellidomaterno}}</h5>
                                <p class="text-muted text-sm"><b>Vehiculo: </b> {{$vin}} / {{$matricula}} / {{$modelo}}/ {{$color}} / {{$anio}} </p>
                            </div>
                            <div class="col-3 text-center">
                                <img src="vendor/adminlte/dist/img/logo.png" alt="user-avatar" class="img-circle img-fluid">
                                <p class="text-muted text-sm">{{$asesorasignado ?? ''}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-tools"></i></span> <h6><b><code>{{$descripcion}}</code></b></h6></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <form>
                    <input type="hidden" wire:model.defer="selected_id">
                    <div class="form-group row">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="filenames" wire:model="filenames" multiple>
                                <label class="custom-file-label" for="filenames">
                                    @if ($filenames)
                                        {{count($filenames)}} archivos seleccionados
                                    @else
                                        Seleccione archivo...
                                    @endif
                                </label>
                            </div>
                        </div>
                    </div>
                </form>

                @if ($refacciones > 0)
                    <div class="table-responsive">
                        <table class="table m-0 table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Propuesta</th>
                                    <th class="text-right">Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Models\Refaccion::where('reparacion_id', $selected_id)->get() as $refaccion)
                                    <tr>
                                        <td class='align-middle'>{{ $loop->iteration }}</td>
                                        <td class='align-middle'><a href="{{url($refaccion->path)}}" target="_blank">{{$refaccion->filename}}</a></td>
                                        <td class="text-right align-middle">{{number_format($refaccion->total, 2, '.', ',')}}</td>
                                        <td class='align-middle'>
                                            @if ($refaccion->status_id === NULL)
                                                <button type="button" class="btn btn-danger btn-sm float-right" onclick="confirm('Confirmar eliminacion de propuesta? \nNo se podra deshacer!')||event.stopImmediatePropagation()" wire:click="destroy({{$refaccion->id}})"><i class="fas fa-trash"></i></button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>
