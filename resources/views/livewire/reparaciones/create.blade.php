<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Importando Citas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">

				<form wire:submit.prevent="submit">
                    <div class="custom-file">
                        <input wire:model="file" type="file" name="file" class="custom-file-input" id="file">
                        <label class="custom-file-label" for="file">
                            @if ($file)
                                {{$file->getClientOriginalName()}}
                            @else
                                Seleccione archivo
                            @endif
                        </label>
                        @error('file')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="store()" class="btn btn-success close-modal">Importar Citas</button>
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
