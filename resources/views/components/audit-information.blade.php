@props(['id', 'maxWidth', 'audit'])

@php
$id = $id ?? md5($attributes->wire('model'));

$maxWidth = [
    'sm' => ' modal-sm',
    'md' => '',
    'lg' => ' modal-lg',
    'xl' => ' modal-xl',
][$maxWidth ?? 'md'];
@endphp

<!-- Modal -->
<div
    x-data="{
        showauditor: @entangle($attributes->wire('model')).defer,
    }"
    x-init="() => {

        let el = document.querySelector('#modal-id-{{ $id }}')

        let modal = new bootstrap.Modal(el);

        $watch('showauditor', value => {
            if (value) {
                modal.show()
            } else {
                modal.hide()
            }
        });

        el.addEventListener('hide.bs.modal', function (event) {
          showauditor = false;          
        })

        $('#modal-id-{{ $id }}').on('hidden.bs.modal', function() {            
            Livewire.emit('showaudit');
          })
    }"
    wire:ignore.self
    class="modal fade"
    tabindex="-1"
    id="modal-id-{{ $id }}"
    aria-labelledby="modal-id-{{ $id }}"
    aria-hidden="true"
    x-ref="modal-id-{{ $id }}">

    <div class="modal-dialog{{ $maxWidth }}">
        <div class="modal-content">
            <div class="modal-header p-3" style="background-color: rgb(205, 93, 221); color:#fff;">
                <h5 class="modal-title" id="exampleModalLabel">Información Para Auditoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="card-body">
                    <h4 class="card-title">Creado</h4>                    
                    <div class="card card-inverse-success" id="context-menu-multi">
                        <div class="card-body">
                            <p class="card-text">Usuario: {{$audit["creator"]["email"] ?? ''}}</p>
                            <p class="card-text">Fecha: {{$audit["created_at"] ?? ''}}</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Modificado</h4>                    
                    <div class="card card-inverse-warning" id="context-menu-multi">
                        <div class="card-body">
                            <p class="card-text">Usuario: {{$audit["editor"]["email"] ?? ''}}</p>
                            <p class="card-text">Fecha: {{$audit["updated_at"] ?? ''}}</p>                  
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Eliminado</h4>                    
                    <div class="card card-inverse-danger" id="context-menu-multi">
                        <div class="card-body">
                            <p class="card-text">Usuario: {{$audit["destroyer"]["email"] ?? ''}}</p>
                            <p class="card-text">Fecha: {{$audit["deleted_at"] ?? ''}}</p>                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>