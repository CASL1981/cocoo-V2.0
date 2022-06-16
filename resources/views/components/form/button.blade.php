@props([
  'disabled' => false,
  'type' => 'button'])

<button {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge([
    'class' => 'btn m-2']) }}
    type="{{ $type }}"
    >
    {{ $slot }}
</button>
