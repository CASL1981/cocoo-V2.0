<x-otros.modal wire:model="show" maxWidth="lg">
    <x-slot name="title">
        Creación de Producto
    </x-slot>
    <x-form.form>
        <x-slot name="form">
            <div class="row"> 
                <div class="form-group col-md-4">
                    <x-form.label for="name">Descripción</x-form.label>
                    <x-form.input wire:model.defer="name" required maxlength="100"></x-form.input>
                    <x-form.input-error for="name"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="tax">Impuesto</x-form.label>                    
                    <x-form.select wire:model.defer="tax" 
                    :options="['1' => 'Si', '0' => 'No']"></x-form.select>
                    <x-form.input-error for="tax"></x-form.input-error>
                </div>
                <div class="form-group col-md-4">
                    <x-form.label for="basic_client_id">Proveedor</x-form.label>                    
                    <x-form.select wire:model.defer="basic_client_id" :options="$providers"></x-form.select>
                    <x-form.input-error for="basic_client_id"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="tax_percentage">% Impuesto</x-form.label>
                    <x-form.input wire:model.defer="tax_percentage" type="number"></x-form.input>
                    <x-form.input-error for="tax_percentage"></x-form.input-error>
                </div>
            </div>
            <div class="row">                 
                <div class="form-group col-md-4">
                    <x-form.label for="brand">Marca</x-form.label>
                    <x-form.input wire:model.defer="brand" maxlength="100"></x-form.input>
                    <x-form.input-error for="brand"></x-form.input-error>
                </div>
                <div class="form-group col-md-4">
                    <x-form.label for="measure_unit">Unidad Medida</x-form.label>
                    <x-form.input wire:model.defer="measure_unit" maxlength="100"></x-form.input>
                    <x-form.input-error for="measure_unit"></x-form.input-error>
                </div>
                <div class="form-group col-md-4">
                    <x-form.label for="basic_classification_id">Categoria</x-form.label>                    
                    <x-form.select wire:model.defer="basic_classification_id" :options="$categories"></x-form.select>
                    <x-form.input-error for="basic_classification_id"></x-form.input-error>
                </div>
            </div>            
        </x-slot>
    </x-form.form>
    <x-slot name="actions">
        <x-form.button class="btn-secondary" wire:click="closed()">Cerrar</x-form.button>
        <x-form.button class="btn-primary" wire:click.prevent="method()">Guardar</x-form.button>
    </x-slot>
</x-otros.modal>