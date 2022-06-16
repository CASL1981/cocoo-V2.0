@props([
    'field' => '',
    'sortField' => '{{$sortField}}',
    'sortDirection' => '{{$sortDirection}}',
    ])
    
<th wire:click="sortBy('{{$field}}')" style="cursor: pointer;" {{ $attributes->merge(['class' => 'p-2']) }} >
    {{$slot}}    
</th>