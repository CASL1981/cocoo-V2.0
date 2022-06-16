@props([
  'disabled' => false,
  'type' => 'text'])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'form-control form-control-sm defaultconfig-3',
    'maxlength' => '',
    'placeholder' => '',
    'name' => '' ]) !!}
  type="{{ $type }}"
>