<div class="row">
    <div class="col-12 grid-margin">
      <x-otros.view-card :exportable="$exportable" :audit="$audit">
        <x-slot name="title">Precios</x-slot>
        <x-slot name="button">
          <div class="btn-group float-right" role="group" aria-label="Basic example">
            @can('price delete')
              <button class="btn btn-sm btn-primary" wire:click.prevent="$emit('destroyPrice')" title="Eliminar Registro"
              @if ($bulkDisabled) disabled @endif><i class="fa fa-trash text-eith"></i>
              </button>
            @endcan            
            @can('price update')
              <button class="btn btn-sm btn-primary" wire:click="edit()" title="Modificar Registro"
              @if ($bulkDisabled) disabled @endif><i class="fa fa-edit text-eith"></i>
              </button>
            @endcan
            @can('price create')
            <button class="btn btn-sm btn-primary" wire:click="$set('show', true)" title="Adicionar Registro">
                <i class="fa fa-plus text-with"></i>
            </button>
            @endcan
          </div>
        </x-slot>
        <x-table.table :audit="$audit">
          <x-slot name="head">
            <th class="p-2" width="40px">
              <div class="form-check form-check-flat form-check-primary" >
                  <label class="form-check-label text-danger" style="width:10">
                  <input type="checkbox" class="form-check-input" wire:model="selectAll">
                  <i class="input-helper"></i></label>
              </div>                      
            </th>
            <x-table.th weight="80px" field="id" width="80px">#</x-table.th>            
            <x-table.th field="order_product_id">ProductoId</x-table.th>
            <x-table.th field="order_product_id">Nombre Producto</x-table.th>
            <x-table.th field="basic_client_id">Proveedor</x-table.th>
            <x-table.th field="basic_client_id">Nombre Proveedor</x-table.th>
            <x-table.th field="order_type_price_id">Lista Precio</x-table.th>
            <x-table.th field="date" class="text-center">Vigencia</x-table.th>
            <x-table.th field="value" class="text-center">Valor</x-table.th>            
          </x-slot>
          @forelse ($prices as $key => $item)            
            <tr>
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
              <x-table.td width="80px">{{ $item->id }}</x-table.td>              
              <x-table.td>{{ $item->order_product_id }}</x-table.td>
              <x-table.td>{{ $item->products->name ?? '' }}</x-table.td>              
              <x-table.td>{{ $item->clients->identification}}</x-table.td>
              <x-table.td>{{ $item->clients->client_name ?? '' }}</x-table.td>
              <x-table.td>{{ $item->typeprices->name ?? '' }}</x-table.td>              
              <x-table.td class="text-center">{{ $item->date }}</x-table.td>
              <x-table.td class="text-center">{{ number_format($item->value,2) }}</x-table.td>
            </tr>
          @empty
          <tr>
            <x-table.td colspan="7">
              <x-otros.error-search></x-otros.error-search>
            </x-table.td>              
          </tr>
          @endforelse
        {{-- @include('orders::livewire.price.form') --}}
        </x-table.table>
        <x-slot name="pagination">
          {!! $prices->links() !!}
        </x-slot>
      </x-otros.view-card>
    </div>
  </div>
  
  @push('styles')
  
  @endpush
  @push('scripts')
  <script>
    window.livewire.on('destroyPrice', (id) => {
          Swal.fire({
              title: 'Estas segro?',
              text: "¡Deseas Eliminar este Item!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, Eliminalo!'
              }).then((result) => {
              if (result.isConfirmed) {
                  Livewire.emit('deleteItem')
              }});
          });
  </script>
  @endpush