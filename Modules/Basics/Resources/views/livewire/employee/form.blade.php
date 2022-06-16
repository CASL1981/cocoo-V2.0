<x-otros.modal wire:model="show" maxWidth="lg">
    <x-slot name="title">
        Creación de Empleados
    </x-slot>
    <x-form.form>
        <x-slot name="form">
            <div class="row"> 
                <div class="form-group col-md-2">
                    <x-form.label for="identification">Identificación</x-form.label>
                    <x-form.input wire:model="identification" required maxlength="11" type="numeric"></x-form.input>
                    <x-form.input-error for="identification"></x-form.input-error>
                </div>
                <div class="form-group col-md-4">
                    <x-form.label for="first_name">Nombres</x-form.label>
                    <x-form.input wire:model="first_name" required maxlength="100"></x-form.input>
                    <x-form.input-error for="first_name"></x-form.input-error>
                </div>
                <div class="form-group col-md-4">
                    <x-form.label for="last_name">Apellidos</x-form.label>
                    <x-form.input wire:model="last_name" required maxlength="100"></x-form.input>
                    <x-form.input-error for="last_name"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="type_document">Tipo Documento</x-form.label>
                    <x-form.select wire:model="type_document" 
                    :options="['CC' => 'Cedula', 'TI' => 'Tarjeta Identidad', 'RC' => 'Registro Civil']"></x-form.select>
                    <x-form.input-error for="type_document"></x-form.input-error>
                </div>                
            </div>
            <div class="row"> 
                <div class="form-group col-md-4">
                    <x-form.label for="address">Dirección</x-form.label>
                    <x-form.input wire:model="address" maxlength="192"></x-form.input>
                    <x-form.input-error for="address"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="phone">Telefono</x-form.label>
                    <x-form.input wire:model="phone" maxlength="10"></x-form.input>
                    <x-form.input-error for="phone"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="cel_phone">Celular</x-form.label>
                    <x-form.input wire:model="cel_phone" maxlength="10"></x-form.input>
                    <x-form.input-error for="cel_phone"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="entry_date">Fecha Ingreso</x-form.label>
                    <x-form.input wire:model="entry_date" type="date"></x-form.input>
                    <x-form.input-error for="entry_date"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="vendedor">Vendedor</x-form.label>
                    <x-form.select wire:model="vendedor" 
                    :options="['1' => 'Si', '0' => 'No']"></x-form.select>
                    <x-form.input-error for="vendedor"></x-form.input-error>
                </div>
            </div>
            <div class="row"> 
                <div class="form-group col-md-2">
                    <x-form.label for="gender">Genero</x-form.label>                    
                    <x-form.select wire:model="gender" 
                    :options="['M' => 'Masculino', 'F' => 'Femenino', 'O' => 'Otro']"></x-form.select>
                    <x-form.input-error for="gender"></x-form.input-error>
                </div>
                <div class="form-group col-md-4">
                    <x-form.label for="email">Email</x-form.label>
                    <x-form.input wire:model="email" maxlength="192" type="email"></x-form.input>
                    <x-form.input-error for="email"></x-form.input-error>
                </div>                
                <div class="form-group col-md-2">
                    <x-form.label for="birth_date">Fecha Nacimiento</x-form.label>
                    <x-form.input wire:model="birth_date" type="date"></x-form.input>
                    <x-form.input-error for="birth_date"></x-form.input-error>
                </div>
                <div class="form-group col-md-2">
                    <x-form.label for="location_id">Ubicación</x-form.label>
                    <x-form.select wire:model="location_id" 
                    :options="['1' => 'Oficina Princpal', '1100' => 'Farmacia Valencia', '1200' => 'Farmacia Lorica']"></x-form.select>
                    <x-form.input-error for="location_id"></x-form.input-error>
                </div> 
            </div>
        </x-slot>
    </x-form.form>
    <x-slot name="actions">
        <x-form.button class="btn-secondary" wire:click="closed()">Cerrar</x-form.button>
        <x-form.button class="btn-primary" wire:click.prevent="method()">Guardar</x-form.button>
    </x-slot>
</x-otros.modal>