<x-otros.modal wire:model="show" maxWidth="lg">
    <x-slot name="title">
        Creación de Producto
    </x-slot>
    <x-form.form>
        <x-slot name="form">
            <div class="row"> 
                <div class="form-group col-md-6">
                    <x-form.label for="order_product_id">Producto</x-form.label>                    
                    <x-form.select wire:model.defer="order_product_id" :options="$products"></x-form.select>
                    <x-form.input-error for="order_product_id"></x-form.input-error>
                </div>
                <div class="form-group col-md-3">
                    <x-form.label for="basic_client_id">Proveedor</x-form.label>                    
                    <x-form.select wire:model.defer="basic_client_id" :options="$providers"></x-form.select>
                    <x-form.input-error for="basic_client_id"></x-form.input-error>
                </div>
                <div class="form-group col-md-3">
                    <x-form.label for="basic_type_price_id">Lista Precio</x-form.label>                    
                    <x-form.select wire:model.defer="basic_type_price_id" :options="$typeprices"></x-form.select>
                    <x-form.input-error for="basic_type_price_id"></x-form.input-error>
                </div>
            </div>
            <div class="row">                 
                <div class="form-group col-md-3">
                    <x-form.label for="date">Valido Hasta</x-form.label>
                    <x-form.input wire:model.defer="date" type="date"></x-form.input>
                    <x-form.input-error for="date"></x-form.input-error>
                </div>
                <div class="form-group col-md-3">
                    <x-form.label for="value">Valor Sin Impuesto</x-form.label>
                    <x-form.input wire:model.defer="value" required></x-form.input>
                    <x-form.input-error for="value"></x-form.input-error>
                </div>                
            </div>
            {{-- <div class="row">
                <div class="form-group col-md-12">
                    <x-form.label for="observation">Observaciones</x-form.label>
                    <textarea class="form-control" id="exampleTextarea1" rows="4" wire:model.defer="observation"></textarea>
                    <x-form.input-error for="observation"></x-form.input-error>
                </div>
            </div> --}}
        </x-slot>
    </x-form.form>
    <x-slot name="actions">
        <x-form.button class="btn-secondary" wire:click="closed()">Cerrar</x-form.button>
        <x-form.button class="btn-primary" wire:click.prevent="method()">Guardar</x-form.button>
    </x-slot>
</x-otros.modal>