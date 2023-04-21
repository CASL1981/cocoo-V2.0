<x-otros.modal wire:model="show" maxWidth="lg">
    <x-slot name="title">
        Generar Orden
    </x-slot>
    <x-form.form>
        <x-slot name="form">
            <div class="row">
                <div class="form-group col-md-3">
                    <x-form.label for="basic_client_id">Proveedor</x-form.label>
                    <x-form.select wire:model="basic_client_id" wire:blur="searchprovider()" :options="$providers"></x-form.select>
                    <x-form.input-error for="basic_client_id"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="date">Fecha</x-form.label>
                    <x-form.input wire:model.defer="date" required type="date"></x-form.input>
                    <x-form.input-error for="date"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="basic_payment_id">Plazo</x-form.label>
                    <x-form.select wire:model.defer="basic_payment_id" :options="$payments"></x-form.select>
                    <x-form.input-error for="basic_payment_id"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="basic_payment_interval">Plazo</x-form.label>
                    <x-form.input wire:model.defer="basic_payment_interval" maxlength="50"></x-form.input>
                    <x-form.input-error for="basic_payment_interval"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="delivery_time">Tiempo Entrega</x-form.label>
                    <x-form.input wire:model.defer="delivery_time" maxlength="50"></x-form.input>
                    <x-form.input-error for="delivery_time"></x-form.input-error>
                </div>
                <div class="form-group col-md-1">
                    <x-form.label for="basic_payment_id">Recibido</x-form.label>
                    <x-form.select wire:model.defer="basic_payment_id" :options="['0' => 'No', '1' => 'Si']"></x-form.select>
                    <x-form.input-error for="basic_payment_id"></x-form.input-error>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <x-form.label for="order_type_price_id">Lista Precio</x-form.label>
                    <x-form.select wire:model.defer="basic_type_price_id" :options="$typeprices"></x-form.select>
                    <x-form.input-error for="order_type_price_id"></x-form.input-error>
                </div>
                <div class="form-group col-md-3">
                    <x-form.label for="biller">Id. Aprobado</x-form.label>
                    <x-form.select wire:model.defer="biller" required :options="$employees"></x-form.select>
                    <x-form.input-error for="biller"></x-form.input-error>
                </div>
                <div class="form-group col-md-3">
                    <x-form.label for="responsible">Id. Responsable</x-form.label>
                    <x-form.select wire:model.defer="responsible" required :options="$employees"></x-form.select>
                    <x-form.input-error for="responsible"></x-form.input-error>
                </div>
                <div class="form-group col-md-3">
                    <x-form.label for="basic_classification_id">Categoria</x-form.label>
                    <x-form.select wire:model.defer="basic_classification_id" :options="$categories"></x-form.select>
                    <x-form.input-error for="basic_classification_id"></x-form.input-error>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <x-form.label for="observation">Observaciones</x-form.label>
                    <textarea class="form-control" id="exampleTextarea1" rows="4" wire:model.defer="observation"></textarea>
                    <x-form.input-error for="observation"></x-form.input-error>
                </div>
            </div>
        </x-slot>
    </x-form.form>
    <x-slot name="actions">
        <x-form.button class="btn-secondary" wire:click="closed()">Cerrar</x-form.button>
        <x-form.button class="btn-primary" wire:click.prevent="method()">Guardar</x-form.button>
    </x-slot>
</x-otros.modal>