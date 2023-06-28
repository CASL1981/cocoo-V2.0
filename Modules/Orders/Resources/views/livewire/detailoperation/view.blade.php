<div>
    @if ($selected_id > 0)
        <div class="row mb-1">
            <div class="col-12">
                <div class="card">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="card-body">
                                <div class="md-4">
                                    <h5>Nombre del Proveedor: <strong class="text-info">{{ $provider->client_name }}</strong></h5>
                                </div>
                                <button type="button" wire:click="doAction(0)" class="btn btn-outline-secondary btn-rounded btn-icon float-right">
                                    <i class="fas fa-trash text-danger"></i>
                                </button>
                                <p class="ml-5">Ruc: <strong>{{ $provider->identification }}</strong></p>
                                <p class="ml-5">Telefono: <strong>{{ $provider->phone }}</strong></p>
                                <p class="ml-5">Email: <strong>{{ $provider->email }}</strong></p>
                            </div>

                        </div>
                        <div class="col-md-3 b-1">
                            <div class="card-body">
                                <label for="type"><strong>Datos Orden de Compra</strong></label>
                                <p class="ml-5">#Orden: <strong>{{ $order_id }}</strong></p>
                                <p class="ml-5">Fecha: <strong>{{ $order->date }}</strong></p>
                                <p class="ml-5">Plazo: <strong>{{ $payment }}</strong></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-body">
                                <label for="type"><strong>Datos Precio</strong></label>
                                <p class="ml-5">Lista de Precio: <strong>{{ $type_price }}</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-body">
                            <label for="Seleccione un Proveedor">Seleccione un Proveedor</label>
                            <select name="" id="" class="form-control form-control-lg" wire:model.lazy="selected_id">
                                <option value="Elegir">-- Selecion --</option>
                                @foreach ($providers as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="form-control">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group" wire:ignore>
                    <label><strong>Buscar Producto</strong></label>
                    <select name="" id="" class="form-control" wire:model="product_id">
                        <option value="Elegir">-- Elige un Poducto --</option>
                        @foreach ($products as $key => $item)
                            <option value="{{ $key }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label><strong>Cantidad:</strong></label>
                    <input type="number" wire:model="quantity" class="form-control form-control-sm" placeholder="Cantidad">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label><strong>Descuento Item:</strong></label>
                    <input type="number" wire:model="discount" class="form-control form-control-sm" placeholder="Descuento" value="0">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label><strong>Centro Costo:</strong></label>
                    <select name="" id="" class="form-control form-control-sm" wire:model="basic_destination_id">
                        <option value="Elegir">-- Elige un CC --</option>
                        @foreach ($destinations as $key => $item)
                            <option value="{{ $key }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary float-right mt-4 ml-2" wire:click.prevent="addProduct()">Add</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container-fluid mt-1 d-flex justify-content-center w-100">
                            <div class="table-responsive w-100">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="text-center">C. C.</th>
                                            <th>Descipción</th>
                                            <th class="text-center">Cantidad</th>
                                            <th class="text-center">Valor</th>
                                            <th class="text-center">Descuento</th>
                                            <th class="text-center">Subtotal</th>
                                            <th class="text-center">Accciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderProducts as $key => $product)
                                            {{-- @php
                                                dd($product['status'] === "editing");
                                            @endphp --}}
                                            @if ( $product['status'] === "Editing")

                                                <tr class="text-center" >
                                                    <td class="text-left"> {{ $key + 1 }} </td>
                                                    <td class="text-center"> {{ $product['basic_destination_id'] }} </td>
                                                    <td class="text-left"> {{ $product['product_name'] }} </td>
                                                    <td>
                                                        <input type="number" wire:model="quantity" class="form-control form-control-sm">
                                                    </td>
                                                    <td class="text-center"> {{ $product['price'] }} </td>
                                                    <td class="text-center"> {{ $product['discount'] }} </td>
                                                    <td class="text-center"> {{ $product['subtotal'] }} </td>
                                                    {{-- <td class="text-center"> 0 </td> --}}
                                                    <td>
                                                        <a href="#" class="btn-sm" wire:click.prevent="updateEditingItem({{ $product['id'] }})">
                                                            <i class="fa fa-check fa-lg"></i>
                                                        </a>
                                                        <a href="#" class="btn-sm" wire:click.prevent="cancelEditingItem({{ $product['id'] }})">
                                                            <i class="fa fa-times fa-lg"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                            @else
                                                <tr class="text-center">
                                                    <td class="text-left"> {{ $key + 1 }} </td>
                                                    <td class="text-center"> {{ $product['basic_destination_id'] }} </td>
                                                    <td class="text-left"> {{ $product['product_name'] }} </td>
                                                    <td class="text-center"> {{ $product['quantity'] }} </td>
                                                    <td class="text-center"> {{ number_format($product['price'],0) }} </td>
                                                    <td class="text-center"> {{ number_format($product['discount'],0) }} </td>
                                                    <td class="text-center"> {{ number_format($product['subtotal'],0) }} </td>
                                                    <td>
                                                        <a href="#" class="btn-sm" wire:click.prevent="removeItem({{ $product['id'] }})">
                                                            <i class="fa fa-window-close fa-lg"></i>
                                                        </a>
                                                        <a href="#" class="btn-sm" wire:click.prevent="editingItem({{ $product['id'] }})">
                                                            <i class="fa fa-edit fa-lg"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th class="text-center">{{ $suma_quantity }}</th>
                                            <th class="text-center">{{ number_format($suma_value,0) }}</th>
                                            <th class="text-center">{{ number_format($suma_discount,0) }}</th>
                                            <th class="text-center">{{ number_format($subtotal,0) }}</th>
                                            <th class="text-center">&nbsp;</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="container-fluid mt-2 w-100">
                            <p class="text-right md-2">Subtotal: ${{ number_format($subtotal, 2) }}</p>
                            <p class="text-right md-2">IVA: ${{ number_format($taxiva,2) }}</p>
                            <h4 class="text-right md-2">Total  : ${{ number_format($total,2) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group mr-2 mt-4 float-right">
        <button type="submit" class="btn btn-primary" wire:click.prevent="storeOrder()">Guardar</button>
    </div>
</div>