@props([
  'options' => [],
  'disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
  'class' => 'form-control' ]) !!}>
    <option value="">-- Seleccione --</option>
    @foreach ($options as $key => $option)
        <option value="{{ $key }}">{{ $option }}</option>
    @endforeach
</select>