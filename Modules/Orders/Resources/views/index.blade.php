@extends('orders::layouts.master')

@section('content')
<div class="row">
    <div class="col-md-3 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">Productos</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-inline-block pt-3">
                        <div class="d-md-flex">
                            <h2 class="mb-0">555</h2>
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
    <div class="col-md-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><i class="fas fa-thumbtack"></i>Ordenes Pendientes de Recibir</h4>
            <div class="list-wrapper">
                <ul class="d-flex flex-column-reverse todo-list">
                    <li>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="checkbox" type="checkbox">
                                Meeting with Alisa
                            <i class="input-helper"></i></label>
                        </div>
                        <i class="remove fa fa-times-circle"></i>
                    </li>
                    <li class="completed">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="checkbox" type="checkbox" checked="">
                                Call John
                            <i class="input-helper"></i></label>
                        </div>
                        <i class="remove fa fa-times-circle"></i>
                    </li>
                    <li>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="checkbox" type="checkbox">
                                Create invoice
                            <i class="input-helper"></i></label>
                        </div>
                        <i class="remove fa fa-times-circle"></i>
                    </li>
                    <li>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="checkbox" type="checkbox">
                                Print Statements
                            <i class="input-helper"></i></label>
                        </div>
                        <i class="remove fa fa-times-circle"></i>
                    </li>
                    <li class="completed">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="checkbox" type="checkbox" checked="">
                                Prepare for presentation
                            <i class="input-helper"></i></label>
                        </div>
                        <i class="remove fa fa-times-circle"></i>
                    </li>
                    <li>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="checkbox" type="checkbox">
                                Pick up kids from school
                            <i class="input-helper"></i></label>
                        </div>
                        <i class="remove fa fa-times-circle"></i>
                    </li>
                </ul>
            </div>
        </div>
      </div>
    </div>
    <div class="col-md-5 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">
            <i class="fas fa-rocket"></i>
            Projects
          </h4>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>
                    Assigned to
                  </th>
                  <th>
                    Project name
                  </th>
                  <th>
                    Priority
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="py-1">
                    <img src="../../images/faces/face1.jpg" alt="profile" class="img-sm rounded-circle">
                  </td>
                  <td>
                    South Shyanne
                  </td>
                  <td>
                    <label class="badge badge-warning badge-pill">Medium</label>
                  </td>
                </tr>
                <tr>
                  <td class="py-1">
                    <img src="../../images/faces/face2.jpg" alt="profile" class="img-sm rounded-circle">
                  </td>
                  <td>
                    New Trystan
                  </td>
                  <td>
                    <label class="badge badge-danger badge-pill">High</label>
                  </td>
                </tr>
                <tr>
                  <td class="py-1">
                    <img src="../../images/faces/face3.jpg" alt="profile" class="img-sm rounded-circle">
                  </td>
                  <td>
                    East Helga
                  </td>
                  <td>
                    <label class="badge badge-success badge-pill">Low</label>
                  </td>
                </tr>
                <tr>
                  <td class="py-1">
                    <img src="../../images/faces/face4.jpg" alt="profile" class="img-sm rounded-circle">
                  </td>
                  <td>
                    Omerbury
                  </td>
                  <td>
                    <label class="badge badge-warning badge-pill">Medium</label>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

