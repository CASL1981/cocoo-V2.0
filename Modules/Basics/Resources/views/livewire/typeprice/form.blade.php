<x-otros.modal wire:model="show" maxWidth="lg">
    <x-slot name="title">
        Creación de Lista de Precio
    </x-slot>
    <x-form.form>
        <x-slot name="form">
            <div class="row"> 
                <div class="form-group col-md-6">
                    <x-form.label for="name">Descripción</x-form.label>
                    <x-form.input wire:model.defer="name" required maxlength="100"></x-form.input>
                    <x-form.input-error for="name"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="increment">Incremento</x-form.label>
                    <x-form.input wire:model.defer="increment" type="number"></x-form.input>
                    <x-form.input-error for="increment"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="tax">Impuesto</x-form.label>                    
                    <x-form.select wire:model.defer="tax" :options="['1' => 'Si', '0' => 'No']"></x-form.select>
                    <x-form.input-error for="tax"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="type">Tipo</x-form.label>                    
                    <x-form.select wire:model.defer="type" :options="['FIJO' => 'FIJO', 'VARIABLE' => 'VARIABLE']"></x-form.select>
                    <x-form.input-error for="type"></x-form.input-error>
                </div>                
            </div>
            <div class="row">                 
                <div class="form-group col-md-2">
                    <x-form.label for="minimum">Minimo</x-form.label>
                    <x-form.input wire:model.defer="minimum" type="number"></x-form.input>
                    <x-form.input-error for="minimum"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="maximum">Maximo</x-form.label>
                    <x-form.input wire:model.defer="maximum" type="number"></x-form.input>
                    <x-form.input-error for="maximum"></x-form.input-error>
                </div>
            </div>            
        </x-slot>
    </x-form.form>
    <x-slot name="actions">
        <x-form.button class="btn-secondary" wire:click="closed()">Cerrar</x-form.button>
        <x-form.button class="btn-primary" wire:click.prevent="method()">Guardar</x-form.button>
    </x-slot>
</x-otros.modal>