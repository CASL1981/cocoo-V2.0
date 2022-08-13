<x-otros.modal wire:model="show" maxWidth="md">
    <x-slot name="title">
        Metodos de Pago
    </x-slot>
    <x-form.form>
        <x-slot name="form">
            <div class="row">
                <div class="form-group col-md-12">
                    <x-form.label for="name">Descripción</x-form.label>
                    <x-form.input wire:model.defer="name" required maxlength="100"></x-form.input>
                    <x-form.input-error for="name"></x-form.input-error>
                </div>
            </div>
            <div class="row">                 
                <div class="form-group col-md-4">
                    <x-form.label for="typeinterval">Tipo (D,S,Q,M)</x-form.label>
                    <x-form.input wire:model.defer="typeinterval" maxlength="1"></x-form.input-error>
                    <x-form.input-error for="typeinterval"></x-form.input-error>
                </div>
                <div class="form-group col-md-4">
                    <x-form.label for="quotas"># Cuotas</x-form.label>
                    <x-form.input wire:model.defer="quotas" type="number"></x-form.input>
                    <x-form.input-error for="quotas"></x-form.input-error>
                </div>
                <div class="form-group col-md-4">
                    <x-form.label for="interval">Intervalo</x-form.label>
                    <x-form.input wire:model.defer="interval" type="number"></x-form.input>
                    <x-form.input-error for="interval"></x-form.input-error>
                </div>                
            </div>
        </x-slot>
    </x-form.form>
    <x-slot name="actions">
        <x-form.button class="btn-secondary" wire:click="closed()">Cerrar</x-form.button>
        <x-form.button class="btn-primary" wire:click.prevent="method()">Guardar</x-form.button>
    </x-slot>
</x-otros.modal>