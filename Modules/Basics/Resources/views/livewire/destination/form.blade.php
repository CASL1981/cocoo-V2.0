<x-otros.modal wire:model="show" maxWidth="lg">
    <x-slot name="title">
        Creación de Centros de Costos
    </x-slot>
    <x-form.form>
        <x-slot name="form">
            <div class="row"> 
                <div class="form-group col-md-2">
                    <x-form.label for="costcenter">Centro Costo</x-form.label>
                    <x-form.input wire:model="costcenter" required maxlength="20"></x-form.input>
                    <x-form.input-error for="costcenter"></x-form.input-error>
                </div>
                <div class="form-group col-md-4">
                    <x-form.label for="name">Descripción</x-form.label>
                    <x-form.input wire:model="name" required maxlength="192"></x-form.input>
                    <x-form.input-error for="name"></x-form.input-error>
                </div>
                <div class="form-group col-md-4">
                    <x-form.label for="address">Dirección</x-form.label>
                    <x-form.input wire:model="address" maxlength="254"></x-form.input>
                    <x-form.input-error for="address"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="phone">Telefono</x-form.label>
                    <x-form.input wire:model="phone" maxlength="20"></x-form.input>
                    <x-form.input-error for="phone"></x-form.input-error>
                </div>
            </div>
            <div class="row"> 
                <div class="form-group col-md-2">
                    <x-form.label for="location">Ubicación</x-form.label>
                    <x-form.input wire:model="location" maxlength="20"></x-form.input>
                    <x-form.input-error for="location"></x-form.input-error>
                </div>
                <div class="form-group col-md-1">
                    <x-form.label for="minimun">Minimo</x-form.label>
                    <x-form.input wire:model="minimun" type="number"></x-form.input>
                    <x-form.input-error for="minimun"></x-form.input-error>
                </div>
                <div class="form-group col-md-1">
                    <x-form.label for="maximun">Maximo</x-form.label>
                    <x-form.input wire:model="maximun" type="number"></x-form.input>
                    <x-form.input-error for="maximun"></x-form.input-error>
                </div>                
            </div>
        </x-slot>
    </x-form.form>
    <x-slot name="actions">
        <x-form.button class="btn-secondary" wire:click="closed()">Cerrar</x-form.button>
        <x-form.button class="btn-primary" wire:click.prevent="method()">Guardar</x-form.button>
    </x-slot>
</x-otros.modal>