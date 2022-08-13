<x-otros.modal wire:model="show" maxWidth="md">
    <x-slot name="title">
        Clasificaciones
    </x-slot>
    <x-form.form>
        <x-slot name="form">
            <div class="row">
                <div class="form-group col-md-3">
                    <x-form.label for="code">Codigo</x-form.label>
                    <x-form.input wire:model.defer="code" required maxlength="10"></x-form.input>
                    <x-form.input-error for="code"></x-form.input-error>
                </div>
                <div class="form-group col-md-3">
                    <x-form.label for="level">Nivel</x-form.label>
                    <x-form.input wire:model.defer="level" type="number"></x-form.input-error>
                        <x-form.input-error for="level"></x-form.input-error>
                </div>
                <div class="form-group col-md-3">
                    <x-form.label for="parent">Codigo Padre</x-form.label>
                    <x-form.input wire:model.defer="parent" maxlength="10"></x-form.input>
                    <x-form.input-error for="parent"></x-form.input-error>
                </div>
                <div class="form-group col-md-3">
                    <x-form.label for="impute">Imputable</x-form.label>
                    <x-form.select wire:model.defer="impute" 
                    :options="[1 => 'SI', '0' => 'NO']"></x-form.select>
                    <x-form.input-error for="impute"></x-form.input-error>
                </div>
            </div>
            <div class="row">                 
                <div class="form-group col-md-12">
                    <x-form.label for="name">Descripción</x-form.label>
                    <x-form.input wire:model.defer="name" maxlength="100"></x-form.input>
                    <x-form.input-error for="name"></x-form.input-error>
                </div>                
            </div>
        </x-slot>
    </x-form.form>
    <x-slot name="actions">
        <x-form.button class="btn-secondary" wire:click="closed()">Cerrar</x-form.button>
        <x-form.button class="btn-primary" wire:click.prevent="method()">Guardar</x-form.button>
    </x-slot>
</x-otros.modal>