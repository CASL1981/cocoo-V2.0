<x-otros.modal wire:model="show" maxWidth="lg">
    <x-slot name="title">
        Creación de Tercero
    </x-slot>
    <x-form.form>
        <x-slot name="form">
            <div class="row"> 
                <div class="form-group col-md-2">
                    <x-form.label for="identification">Identificación</x-form.label>
                    <x-form.input wire:model="identification" required maxlength="11" type="numeric"></x-form.input>
                    <x-form.input-error for="identification"></x-form.input-error>
                </div>
                <div class="form-group col-md-3">
                    <x-form.label for="first_name">Nombres</x-form.label>
                    <x-form.input wire:model="first_name" required maxlength="100"></x-form.input>
                    <x-form.input-error for="first_name"></x-form.input-error>
                </div>
                <div class="form-group col-md-3">
                    <x-form.label for="last_name">Apellidos</x-form.label>
                    <x-form.input wire:model="last_name" required maxlength="100"></x-form.input>
                    <x-form.input-error for="last_name"></x-form.input-error>
                </div>
                <div class="form-group col-md-4">
                    <x-form.label for="client_name">Razon Social</x-form.label>
                    <x-form.input wire:model="client_name" required maxlength="100"></x-form.input>
                    <x-form.input-error for="client_name"></x-form.input-error>
                </div>
            </div>
            <div class="row"> 
                <div class="form-group col-md-2">
                    <x-form.label for="type_document">Tipo Documento</x-form.label>
                    <x-form.select wire:model="type_document" 
                    :options="['CC' => 'Cedula', 'TI' => 'Tarjeta Identidad', 'RC' => 'Registro Civil', 'NIT' => 'NIT']"></x-form.select>
                    <x-form.input-error for="type_document"></x-form.input-error>
                </div>
                <div class="form-group col-md-4">
                    <x-form.label for="address">Dirección</x-form.label>
                    <x-form.input wire:model="address" maxlength="192"></x-form.input>
                    <x-form.input-error for="address"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="phone">Telefono</x-form.label>
                    <x-form.input wire:model="phone" maxlength="10" type="number"></x-form.input>
                    <x-form.input-error for="phone"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="cel_phone">Celular</x-form.label>
                    <x-form.input wire:model="cel_phone" maxlength="10" type="number"></x-form.input>
                    <x-form.input-error for="cel_phone"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="entry_date">Fecha Ingreso</x-form.label>
                    <x-form.input wire:model="entry_date" type="date"></x-form.input>
                    <x-form.input-error for="entry_date"></x-form.input-error>
                </div>
            </div>
            <div class="row"> 
                <div class="form-group col-md-2">
                    <x-form.label for="gender">Genero</x-form.label>                    
                    <x-form.select wire:model="gender" 
                    :options="['M' => 'Masculino', 'F' => 'Femenino', 'O' => 'Otro']"></x-form.select>
                    <x-form.input-error for="gender"></x-form.input-error>
                </div>
                <div class="form-group col-md-3">
                    <x-form.label for="email">Email</x-form.label>
                    <x-form.input wire:model="email" maxlength="100" type="email"></x-form.input>
                    <x-form.input-error for="email"></x-form.input-error>
                </div>                
                <div class="form-group col-md-2">
                    <x-form.label for="birth_date">Fecha Nacimiento</x-form.label>
                    <x-form.input wire:model="birth_date" type="date"></x-form.input>
                    <x-form.input-error for="birth_date"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="limit">Cupo</x-form.label>
                    <x-form.input wire:model="limit" type="number"></x-form.input>
                    <x-form.input-error for="limit"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="type">Tipo Tercero</x-form.label>                    
                    <x-form.select wire:model="type" 
                    :options="['Vendedor' => 'Vendedor', 'Cliente' => 'Cliente', 'Otro' => 'Otro']"></x-form.select>
                    <x-form.input-error for="type"></x-form.input-error>
                </div>
            </div>
            <div class="row"> 
                <div class="form-group col-md-2">
                    <x-form.label for="vendedor_id">Vendedor</x-form.label>
                    <x-form.select wire:model="vendedor_id" 
                    :options="$vendedores"></x-form.select>
                    <x-form.input-error for="vendedor_id"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="pricelist_id">Lista Precio</x-form.label>
                    <x-form.select wire:model="pricelist_id" 
                    :options="['1' => 'Monteria', '2' => 'Cerete', '3' => 'Lorica']"></x-form.select>
                    <x-form.input-error for="pricelist_id"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="shoppingcontact">Contacto Compra</x-form.label>
                    <x-form.input wire:model="shoppingcontact" required maxlength="100"></x-form.input>
                    <x-form.input-error for="shoppingcontact"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="conditionpayment_id">Condición Pago</x-form.label>
                    <x-form.select wire:model="conditionpayment_id" 
                    :options="['1' => 'Contado', '2' => 'Credito 30 días', '3' => 'Credito 60 días']"></x-form.select>
                    <x-form.input-error for="conditionpayment_id"></x-form.input-error>
                </div>                
            </div>
        </x-slot>
    </x-form.form>
    <x-slot name="actions">
        <x-form.button class="btn-secondary" wire:click="closed()">Cerrar</x-form.button>
        <x-form.button class="btn-primary" wire:click.prevent="method()">Guardar</x-form.button>
    </x-slot>
</x-otros.modal>