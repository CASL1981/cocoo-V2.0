
<div id="updateperfil-right-sidebar" class="settings-panel"

x-data="{ show: @entangle('show') }"
x-init="() => {

    let el = document.querySelector('#updateperfil-right-sidebar')   

    $watch('show', value => {
        if (value) {            
            $('#updateperfil-right-sidebar').toggleClass('open');            
        } else {
            $('#updateperfil-right-sidebar').removeClass('open');            
        }
    });    
}"
wire:ignore.self
tabindex="-1"
>
  <i class="settings-close fa fa-times" wire:click="$set('show', false)"></i>
  <ul class="nav nav-tabs" id="setting-panel" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">Actualizar Perfil</a>
    </li>
  </ul>
  
  <div class="tab-content" id="setting-content">
    <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
       {{-- ------- form ---------- --}}
       <x-form.form>
           <x-slot name="form">
               <div class="row"> 
                   <div class="form-group col-md-3">
                       <x-form.label for="identification">Identificación</x-form.label>
                       <x-form.input wire:model="identification" required maxlength="100"></x-form.input>                    
                       <x-form.input-error for="identification"></x-form.input-error>
                    </div>
                    <div class="form-group col-md-6">
                        <x-form.label for="position">Cargo</x-form.label>
                        <x-form.input wire:model="position" required maxlength="100"></x-form.input>                    
                        <x-form.input-error for="position"></x-form.input-error>
                    </div>
                    <div class="form-group col-md-3">
                        <x-form.label for="phone">Telefono</x-form.label>
                        <x-form.input wire:model="phone" required maxlength="20"></x-form.input>
                        <x-form.input-error for="phone"></x-form.input-error>
                    </div>
                </div>                
                <div class="row"> 
                    <div class="form-group col-md-6">
                        <x-form.label for="profession">Profesión</x-form.label>
                        <x-form.input wire:model="profession" required maxlength="100"></x-form.input>                    
                        <x-form.input-error for="profession"></x-form.input-error>
                    </div>
                    <div class="form-group col-md-6">
                        <x-form.label for="address">Dirección</x-form.label>
                        <x-form.input wire:model="address" required maxlength="192"></x-form.input>                    
                        <x-form.input-error for="address"></x-form.input-error>
                    </div>
                </div>
                <div class="row"> 
                    <div class="form-group col-md-12">
                        <x-form.label for="bio">Biografia</x-form.label>
                        <textarea name="bio" wire:model="bio" rows="4" maxlength="300" class="form-control"></textarea>
                        <x-form.input-error for="bio"></x-form.input-error>
                    </div>
                </div>                
                <div class="row"> 
                    <div class="form-group col-md-4">
                        <x-form.label for="facebook">Facebook</x-form.label>
                        <x-form.input wire:model="facebook" required maxlength="40"></x-form.input>                    
                        <x-form.input-error for="facebook"></x-form.input-error>
                    </div>
                    <div class="form-group col-md-4">
                        <x-form.label for="twitter">Twitter</x-form.label>
                        <x-form.input wire:model="twitter" required maxlength="20"></x-form.input>                    
                        <x-form.input-error for="twitter"></x-form.input-error>
                    </div>
                    <div class="form-group col-md-4">
                        <x-form.label for="instagram">Instagram</x-form.label>
                        <x-form.input wire:model="instagram" required maxlength="20"></x-form.input>                    
                        <x-form.input-error for="instagram"></x-form.input-error>
                    </div>
                </div>
                <div class="row">
                    <x-form.button class="btn-secondary" wire:click="closed()">Cerrar</x-form.button>
                    <x-form.button class="btn-primary" wire:click.prevent="update()">Guardar</x-form.button>
                </div>
            </x-slot>
        </x-form.form>
       {{-- ------- end form ---------- --}}
    </div>
  </div>
</div>