<x-otros.modal wire:model="show">
    <x-slot name="title">
        Creación de Roles
    </x-slot>
    <x-form.form>
        <x-slot name="form">
            <div class="row"> 
                <div class="form-group col-md-12">
                 <x-form.label for="name">Nombre Role</x-form.label>
                 <x-form.input wire:model="name" required maxlength="100"></x-form.input>                    
                 <x-form.input-error for="name"></x-form.input-error>
                </div>
            </div>                          
        </x-slot>
    </x-form.form>
    <x-slot name="actions">
        <button type="button" class="btn btn-secondary m-2" wire:click="closed()">Cerrar</button>
        <button type="button" class="btn btn-primary m-2" wire:click.prevent="method()">Guardar</button>
    </x-slot>
</x-otros.modal>