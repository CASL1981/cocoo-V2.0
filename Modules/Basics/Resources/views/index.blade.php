@extends('basics::layouts.master')

@section('content')
<div class="row">
    <div class="col-md-3 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">Centros de costos</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-inline-block pt-3">
                        <div class="d-md-flex">
                            <h2 class="mb-0">{{ $centercost }}</h2>
                            <div class="d-flex align-items-center ml-md-2 mt-2 mt-md-0">
                                <i class="far fa-clock text-muted"></i>
                                <small class=" ml-1 mb-0">Updated: 9:10am</small>
                            </div>
                        </div>
                        <small class="text-gray">Raised from 89 orders.</small>
                    </div>
                    <div class="d-inline-block">
                        <i class="fas fa-chart-pie text-info icon-lg"></i>                                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">Empleados</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-inline-block pt-3">
                        <div class="d-md-flex">                            
                            <h2 class="mb-0">{{ $employees }}</h2>
                            <div class="d-flex align-items-center ml-md-2 mt-2 mt-md-0">
                                <i class="far fa-clock text-muted"></i>
                                <small class="ml-1 mb-0">Updated: 05:42pm</small>
                            </div>
                        </div>
                        <small class="text-gray">hey, let’s have lunch together</small>
                    </div>
                    <div class="d-inline-block">
                        <i class="fas fa-address-card text-danger icon-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">Clientes</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-inline-block pt-3">
                        <div class="d-md-flex">
                            <h2 class="mb-0">{{ $clients }}</h2>
                            <div class="d-flex align-items-center ml-md-2 mt-2 mt-md-0">
                                <i class="far fa-clock text-muted"></i>
                                <small class="ml-1 mb-0">Updated: 05:42pm</small>
                            </div>
                        </div>
                        <small class="text-gray">hey, let’s have lunch together</small>
                    </div>
                    <div class="d-inline-block">
                        <i class="fas fa-users text-warning icon-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">Daily Order</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-inline-block pt-3">
                        <div class="d-md-flex">
                            <h2 class="mb-0">$2256</h2>
                            <div class="d-flex align-items-center ml-md-2 mt-2 mt-md-0">
                                <i class="far fa-clock text-muted"></i>
                                <small class="ml-1 mb-0">Updated: 05:42pm</small>
                            </div>
                        </div>
                        <small class="text-gray">hey, let’s have lunch together</small>
                    </div>
                    <div class="d-inline-block">
                        <i class="fas fa-shopping-cart text-danger icon-lg"></i>                                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
