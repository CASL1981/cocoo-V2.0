@extends('orders::layouts.master')

@section('content')
    <div class="row grid-margin">        
        <div class="col-12">    
            <h3>Tipo de precio</h3>
            <livewire:orders::type-price />
            {{-- <livewire:orders::products /> --}}
        </div>
    </div>
@endsection