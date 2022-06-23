<div class="row">
    <div class="col-12 grid-margin">
      <x-otros.view-card :exportable="$exportable" :audit="$audit">
        <x-slot name="title">Lista de Precio</x-slot>
        <x-slot name="button">
          <div class="btn-group float-right" role="group" aria-label="Basic example">
            @can('product delete')
              <button class="btn btn-sm btn-primary" wire:click.prevent="$emit('destroyTypePrice')" title="Eliminar Registro"
              @if ($bulkDisabled) disabled @endif><i class="fa fa-trash text-eith"></i>
              </button>
            @endcan
            @can('product toggle')
                <button class="btn btn-sm btn-primary" wire:click.prevent="$emit('toggleTypePrice')" title="Activar o Desactivar Item"
                @if ($bulkDisabled) disabled @endif><i class="fa fa-exclamation text-with"></i>
                </button>                
            @endcan
            @can('product update')
              <button class="btn btn-sm btn-primary" wire:click="edit()" title="Modificar Registro"
              @if ($bulkDisabled) disabled @endif><i class="fa fa-edit text-eith"></i>
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
            <x-table.th field="name">Descripción</x-table.th>
            <x-table.th field="increment" class="text-center">Incremento</x-table.th>
            <x-table.th field="tax" class="text-center">Impuesto</x-table.th>
            <x-table.th field="status" class="text-center">Estatus</x-table.th>
            <x-table.th field="type">Typo</x-table.th>
            <x-table.th field="minimum">Minimo</x-table.th>
            <x-table.th field="maximum" class="text-center">Maximo</x-table.th>            
          </x-slot>
          @forelse ($typeprices as $key => $item)            
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
              <x-table.td>{{ $item->name }}</x-table.td>
              <x-table.td>{{ $item->increment }}</x-table.td>
              <x-table.td class="text-center">{{ $item->tax ? 'Si' : 'No' }}</x-table.td>
              <x-table.td class="text-{{ $item->status_color }}">{{ $item->status ? 'Activo' : 'Inacivo' }}</x-table.td>
              <x-table.td>{{ $item->type }}</x-table.td>
              <x-table.td>{{ $item->minimun }}</x-table.td>
              <x-table.td>{{ $item->maximum }}</x-table.td>              
            </tr>
          @empty
          <tr>
            <x-table.td colspan="7">
              <x-otros.error-search></x-otros.error-search>
            </x-table.td>              
          </tr>
          @endforelse
        @include('orders::livewire.typeprice.form')
        </x-table.table>
        <x-slot name="pagination">
          {!! $typeprices->links() !!}
        </x-slot>
      </x-otros.view-card>
    </div>
  </div>
  
  @push('styles')
  
  @endpush
  @push('scripts')
  <script>
    window.livewire.on('destroyTypePrice', (id) => {
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
                  Livewire.emit('deleteTypePrice')
              }});
          });
  </script>
  @endpush