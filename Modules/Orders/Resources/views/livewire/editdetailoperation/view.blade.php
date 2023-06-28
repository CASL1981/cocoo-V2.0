<div class="row">
    <div class="col-12 grid-margin">
      <x-otros.view-card :exportable="$exportable" :audit="$audit">
        <x-slot name="title">Editar OC</x-slot>
        <x-slot name="button">
          <div class="btn-group float-right" role="group" aria-label="Basic example">


            @can('operation update')
            <button class="btn btn-sm btn-primary" wire:click="showModalSearch()" title="Consultar Registro"><i class="fa fa-search text-with"></i>
            </button>
            <button class="btn btn-sm btn-primary" wire:click="edit()" title="Modificar Registro"
            @if ($bulkDisabled) disabled @endif><i class="fa fa-edit text-with"></i>
            </button>
            @endcan

          </div>
        </x-slot>
        <x-table.table :audit="$audit">
          <x-slot name="head" >
            <th class="p-2" width="40px">
              <div class="form-check form-check-flat form-check-primary" >
                  <label class="form-check-label text-danger" style="width:10">
                  <input type="checkbox" class="form-check-input" wire:model="selectAll">
                  <i class="input-helper"></i></label>
              </div>
            </th>
            <x-table.th weight="80px" field="id" width="80px">#</x-table.th>
            <x-table.th field="order_product_id">ProdId</x-table.th>
            <x-table.th field="product_name">Descrpicion Producto</x-table.th>
            <x-table.th field="quantity">Cantidad</x-table.th>
            <x-table.th field="price" class="text-center">Precio</x-table.th>
            <x-table.th field="discount">Descuento</x-table.th>
            <x-table.th field="discount_percentage">Porcent. Descuen.</x-table.th>
            <x-table.th field="subtotal" class="text-center">Subtotal</x-table.th>
            <x-table.th field="tax_sale" class="text-center">IVA</x-table.th>
            <x-table.th field="tax_sale_percentage" class="text-center">Tarifa</x-table.th>
            <x-table.th field="total" class="text-center">Total</x-table.th>
            <x-table.th field="measure_unitd" class="text-center">Unidad Medida</x-table.th>
            <x-table.th field="brand" class="text-center">Marca</x-table.th>
            <x-table.th field="order_operation_id" class="text-center">#Orden</x-table.th>
            <x-table.th field="basic_destination_id" class="text-center">Centro Cos.</x-table.th>
            <x-table.th field="status" class="text-center">Estado</x-table.th>
          </x-slot>

          @forelse ($detail_order as $key => $item)

            <tr class="{{ $item->status === 'Cancelled' ? 'text-danger' : '' }}">
              <td class="p-1" width="40px">
                <div class="form-check form-check-flat form-check-primary">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input"
                    wire:model="selectedModel"
                    value="{{$item->id}}"
                    wire:click="$set('selected_id',{{$item->id}})"
                    id="status{{$key}}">
                <i class="input-helper"></i></label>
                </div>
              </td>
              <td class="text-nowrap">{{ $loop->iteration }}</td>
              <td class="text-nowrap" weigth="80px">{{ $item->order_product_id }}</td>
              <td class="text-nowrap">{{ $item->product_name }}</td>
              <td class="text-nowrap">{{ $item->quantity }}</td>
              <td class="text-nowrap text-right">{{ number_format($item->price, 0) }}</td>
              <td class="text-nowrap text-right">{{ number_format($item->discount, 0) }}</td>
              <td class="text-nowrap text-right">{{ $item->discount_percentage }}</td>
              <td class="text-nowrap text-right">{{ number_format($item->subtotal, 0) }}</td>
              <td class="text-nowrap text-right">{{ number_format($item->tax_sale, 0) }}</td>
              <td class="text-nowrap text-right">{{ $item->tax_sale_percentage }}</td>
              <td class="text-nowrap text-right">{{ number_format($item->total, 0) }}</td>
              <td class="text-nowrap">{{ $item->measure_unitd }}</td>
              <td class="text-nowrap">{{ $item->brand }}</td>
              <td class="text-nowrap">{{ $item->order_operation_id }}</td>
              <td class="text-nowrap">{{ $item->basic_destination_id }}</td>
              <td class="text-nowrap text-{{ $item->status_color }}">{{ $item->status }}</td>
            </tr>
          @empty
          <tr>
            <x-table.td colspan="7">
              <x-otros.error-search></x-otros.error-search>
            </x-table.td>
          </tr>
          @endforelse
        @include('orders::livewire.editdetailoperation.form')
        @include('orders::livewire.editdetailoperation.search')
        </x-table.table>
        <x-slot name="pagination">
          {!! $detail_order->links() !!}
        </x-slot>
      </x-otros.view-card>
    </div>
</div>

@push('styles')

@endpush
@push('scripts')
<script>
  window.livewire.on('destroyItem', (id) => {
        Swal.fire({
            title: 'Estas segro?',
            text: "¡Deseas Eliminar este Item!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminala!'
            }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('deleteItem')
            }});
        });
</script>
@endpush