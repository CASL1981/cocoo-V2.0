{{-- <x-app-layout>    
</x-app-layout> --}}
@extends('basics::layouts.master')

@section('content')
    <div class="row grid-margin">        
        <div class="col-12">
            <livewire:basics::destinations />
        </div>
    </div>
@endsection