<x-otros.modal wire:model="show" maxWidth="lg">
    <x-slot name="title">
        Detalle Ordenes
    </x-slot>
    <x-form.form>
        <x-slot name="form">
            <div class="row">
                <div class="form-group col-md-4">
                    <x-form.label for="product_name">Producto</x-form.label>
                    <x-form.input wire:model.defer.defer="product_name" type="text" required maxlength="100"></x-form.input>
                    <x-form.input-error for="product_name"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="quantity">Cantidad</x-form.label>
                    <x-form.input wire:model.defer="quantity" type="number" disabled></x-form.input>
                    <x-form.input-error for="quantity"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="price">Precio</x-form.label>
                    <x-form.input wire:model.defer="price" type="number" disabled></x-form.input>
                    <x-form.input-error for="price"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="discount">Descuento</x-form.label>
                    <x-form.input wire:model.defer="discount" type="text" disabled></x-form.input>
                    <x-form.input-error for="discount"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="discount_percentage">Porce. Desc.</x-form.label>
                    <x-form.input wire:model.defer="discount_percentage" type="number" disabled></x-form.input>
                    <x-form.input-error for="discount_percentage"></x-form.input-error>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-2">
                    <x-form.label for="subtotal">Subtotal</x-form.label>
                    <x-form.input wire:model.defer="subtotal" type="number" disabled></x-form.input>
                    <x-form.input-error for="subtotal"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="tax_sale">Valor Impuesto</x-form.label>
                    <x-form.input wire:model.defer="tax_sale" type="number" disabled></x-form.input>
                    <x-form.input-error for="tax_sale"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="tax_sale_percentage">Porcentaje Impuesto</x-form.label>
                    <x-form.input wire:model.defer="tax_sale_percentage" type="number" disabled></x-form.input>
                    <x-form.input-error for="tax_sale_percentage"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="total">Total</x-form.label>
                    <x-form.input wire:model.defer="total" type="number" disabled></x-form.input>
                    <x-form.input-error for="total"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="measure_unitd">UM</x-form.label>
                    <x-form.input wire:model.defer="measure_unitd" type="text" maxlength="100"></x-form.input>
                    <x-form.input-error for="measure_unitd"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="brand">Marca</x-form.label>
                    <x-form.input wire:model.defer="brand" type="text" maxlength="100"></x-form.input>
                    <x-form.input-error for="brand"></x-form.input-error>
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