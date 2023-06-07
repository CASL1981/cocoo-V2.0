@extends('orders::layouts.master')

@section('content')
<div class="row">
    <div class="col-md-3 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">Ordernes de Compra</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-inline-block pt-3">
                        <div class="d-md-flex">
                            <h2 class="mb-0">{{ $orderShopping }}</h2>
                            <div class="d-flex align-items-center ml-md-2 mt-2 mt-md-0">
                                <i class="far fa-clock text-muted"></i>
                                <small class=" ml-1 mb-0">Actualizado: {{ $orderLast->updated_at }}</small>
                            </div>
                          </div>
                          <small class="text-gray">Ultima ordern {{ $orderLast->id }} del </small><br><small> {{ $orderLast->date }}.</small>
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
                <h4 class="card-title mb-0">Test 2</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-inline-block pt-3">
                        <div class="d-md-flex">
                            <h2 class="mb-0">555</h2>
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
                <h4 class="card-title mb-0">Test 3</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-inline-block pt-3">
                        <div class="d-md-flex">
                            <h2 class="mb-0">555</h2>
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
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><i class="fas fa-thumbtack"></i>Utimas 10 Ordenes Pendientes de Recibir</h4>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Proveedor</th>
                  <th>Orden</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($orderPenddingRecibir as $item)
                  <tr>
                    <td>{{ $item->basic_client_name }}</td>
                    <td class="text-center">{{ $item->id }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">
            <i class="fas fa-rocket"></i>
            Ultimas Ordes de Compra
          </h4>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>
                    Proveedor
                  </th>
                  <th>
                    Valor
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($ordersLasts as $item)
                  <tr>
                    <td>
                      {{ $item->basic_client_name }}
                    </td>
                    <td>
                      <label class="badge badge-warning badge-pill">{{ $item->total }}</label>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection