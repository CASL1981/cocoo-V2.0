<x-app-layout title="Roles">
    <div class="row grid-margin">
        <div class="col-md-6">            
            @livewire('roles')
        </div>
        <div class="col-md-5 offset-md-1">
            @livewire('permissions')
        </div>
    </div>
</x-app-layout>