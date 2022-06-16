@props(['id', 'maxWidth'])

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
        show: @entangle($attributes->wire('model')).defer,
    }"
    x-init="() => {

        let el = document.querySelector('#modal-id-{{ $id }}')

        let modal = new bootstrap.Modal(el);

        $watch('show', value => {
            if (value) {
                modal.show()
            } else {
                modal.hide()
            }
        });

        el.addEventListener('hide.bs.modal', function (event) {
          show = false
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
                <h5 class="modal-title" id="exampleModalLabel">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                {{ $slot }}
            </div>                
            <div class="modal-footer">
                @if (isset($actions))
                    {{ $actions }}                
                @endif          
            </div>
        </div>
      </div>
    </div>
</div>