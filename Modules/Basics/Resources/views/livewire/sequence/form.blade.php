<x-otros.modal wire:model="show" maxWidth="lg">
    <x-slot name="title">
        Consecutivos - Documentos
    </x-slot>
    <x-form.form>
        <x-slot name="form">            
            <div class="row">                 
                <div class="form-group col-md-2">
                    <x-form.label for="document">Documento</x-form.label>
                    <x-form.input wire:model.defer="document" maxlength="3"></x-form.input>
                    <x-form.input-error for="document"></x-form.input-error>
                </div>
                <div class="form-group col-md-8">
                    <x-form.label for="document_name">Nombre Documento</x-form.label>
                    <x-form.input wire:model.defer="document_name" maxlength="100"></x-form.input>
                    <x-form.input-error for="document_name"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="number">Numero</x-form.label>
                    <x-form.input wire:model.defer="number" type="number"></x-form.input>
                    <x-form.input-error for="number"></x-form.input-error>
                </div>                
            </div>
        </x-slot>
    </x-form.form>
    <x-slot name="actions">
        <x-form.button class="btn-secondary" wire:click="closed()">Cerrar</x-form.button>
        <x-form.button class="btn-primary" wire:click.prevent="method()">Guardar</x-form.button>
    </x-slot>
</x-otros.modal>