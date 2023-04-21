<div class="row">
    <div class="col-12 grid-margin">
      <x-otros.view-card :exportable="$exportable" :audit="$audit">
        <x-slot name="title">Ordenes de Compra</x-slot>
        <x-slot name="button">
          <div class="btn-group float-right" role="group" aria-label="Basic example">


            <a href="{{route('order.pdf', $selected_id)}}" target=”_blank” title="Exportar a PDF"
            class="btn btn-sm btn-primary {{ $bulkDisabled ? 'disabled' : '' }}"><i class="fa fa-file-pdf text-with"></i></a>
            @can('operation reverse')
            <button class="btn btn-sm btn-primary" wire:click.prevent="$emit('reverseItem')" title="Reversar Registro"
            @if ($bulkDisabled) disabled @endif><i class="fa fa-history text-with"></i>
            </button>
            @endcan
            @can('operation process')
            <button class="btn btn-sm btn-primary" wire:click.prevent="$emit('processItem')" title="Procesar Registro"
            @if ($bulkDisabled) disabled @endif><i class="fa fa-save text-with"></i>
            </button>
            @endcan
            @can('operation process')
            <button class="btn btn-sm btn-primary" wire:click.prevent="$emit('detailOrder')" title="Adicionar Registros a la Orden"
            @if ($bulkDisabled) disabled @endif><i class="fa fa-list-alt text-with"></i>
            </button>
            @endcan
            @can('operation delete')
            <button class="btn btn-sm btn-primary" wire:click.prevent="$emit('destroyItem')" title="Eliminar Registro"
            @if ($bulkDisabled) disabled @endif><i class="fa fa-trash text-with"></i>
            </button>
            @endcan
            @can('operation toggle')
            <button class="btn btn-sm btn-primary" wire:click.prevent="$emit('toggleItem')" title="Activar o Desactivar Item"
            @if ($bulkDisabled) disabled @endif><i class="fa fa-exclamation text-with"></i>
            </button>
            @endcan
            @can('product update')
            <button class="btn btn-sm btn-primary" wire:click="receive()" title="Recibir Orden"
            @if ($bulkDisabled) disabled @endif><i class="fa fa-check text-with"></i>
            </button>
            @endcan
            @can('product update')
            <button class="btn btn-sm btn-primary" wire:click="edit()" title="Recibir Order"
            @if ($bulkDisabled) disabled @endif><i class="fa fa-edit text-with"></i>
            </button>
            @endcan
            @can('product create')
            <button class="btn btn-sm btn-primary" wire:click="$set('show', true)" title="Adicionar Registro">
            <i class="fa fa-plus text-with"></i>
            </button>
            @endcan
          </div>
        </x-slot>
        <x-table.table :audit="$audit">
          <x-slot name="head" model="$payments">
            <th class="p-2" width="40px">
              <div class="form-check form-check-flat form-check-primary" >
                  <label class="form-check-label text-danger" style="width:10">
                  <input type="checkbox" class="form-check-input" wire:model="selectAll">
                  <i class="input-helper"></i></label>
              </div>
            </th>
            <x-table.th weight="80px" field="id" width="80px">#</x-table.th>
            <x-table.th field="date">Fecha</x-table.th>
            <x-table.th field="basic_client_id">Proveedor</x-table.th>
            <x-table.th field="basic_client_name">Nombre Proveedor</x-table.th>
            <x-table.th field="status" class="text-center">Estado</x-table.th>
            <x-table.th field="basic_payment_name">Condición Pago</x-table.th>
            <x-table.th field="basic_payment_interval">Plazo</x-table.th>
            <x-table.th field="basic_payment_interval">Tiempo Entrega</x-table.th>
            <x-table.th field="observation">Observaciones</x-table.th>
            <x-table.th field="basic_type_price_id">Lista Precio</x-table.th>
            <x-table.th field="biller" class="text-center">Revisado</x-table.th>
            <x-table.th field="responsible" class="text-center">Responsable</x-table.th>
            <x-table.th field="basic_classification_name" class="text-center">Categoria</x-table.th>
            <x-table.th field="brute" class="text-center">Valor Bruto</x-table.th>
            <x-table.th field="discount" class="text-center">Descuento</x-table.th>
            <x-table.th field="subtotal" class="text-center">Subtotal</x-table.th>
            <x-table.th field="tax_sale" class="text-center">Impuesto</x-table.th>
            <x-table.th field="total" class="text-center">Total</x-table.th>
          </x-slot>
          @forelse ($operations as $key => $item)
            <tr class="{{ $item->status === 'Cancelled' ? 'text-danger' : '' }} {{ $item->recibido ? 'text-success' : '' }}">
              <td class="p-1" width="40px">
                <div class="form-check form-check-flat form-check-primary">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input"
                    wire:model="selectedModel"
                    value="{{$item->id}}"
                    wire:click="$set('selected_id',{{$item->id}})"
                    >
                <i class="input-helper"></i></label>
                </div>
              </td>
              <td class="text-nowrap" weigth="80px">{{ $item->id }}</td>
              <td class="text-nowrap">{{ $item->date }}</td>
              <td class="text-nowrap">{{ $item->clients->identification }}</td>
              <td class="text-nowrap">{{ $item->basic_client_name }}</td>
              <td class="text-nowrap text-{{ $item->status_color }}">{{ $item->status }}</td>
              <td class="text-nowrap">{{ $item->basic_payment_name }}</td>
              <td class="text-nowrap">{{ $item->basic_payment_interval }}</td>
              <td class="text-nowrap">{{ $item->delivery_time }}</td>
              <td class="text-nowrap" title="{{$item->observation}}">{{ Str::limit($item->observation,40) }}</td>
              <td class="text-nowrap">{{ $item->basic_type_price_name }}</td>
              <td class="text-nowrap">{{ $item->biller }}</td>
              <td class="text-nowrap">{{ $item->responsible }}</td>
              <td class="text-nowrap">{{ $item->basic_classification_name }}</td>
              <td class="text-nowrap text-right">{{ number_format($item->brute, 0) }}</td>
              <td class="text-nowrap text-right">{{ number_format($item->discount, 0) }}</td>
              <td class="text-nowrap text-right">{{ number_format($item->subtotal, 0) }}</td>
              <td class="text-nowrap text-right">{{ number_format($item->tax_sale, 0) }}</td>
              <td class="text-nowrap text-right">{{ number_format($item->total, 0) }}</td>
            </tr>
          @empty
          <tr>
            <x-table.td colspan="7">
              <x-otros.error-search></x-otros.error-search>
            </x-table.td>
          </tr>
          @endforelse
        @include('orders::livewire.operation.form')
        </x-table.table>
        <x-slot name="pagination">
          {!! $operations->links() !!}
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