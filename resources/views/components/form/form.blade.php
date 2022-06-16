@props(['submit' => ''])

<form wire:submit.prevent="{{ $submit }}">
    <div class="card-body">
        {{ $form }}
    </div>                                         
</form>  