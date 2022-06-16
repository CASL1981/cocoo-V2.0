<div class="row">
    <div class="col-12 grid-margin">
      <x-otros.view-card :exportable="$exportable" :audit="$audit">
        <x-slot name="title">Condición de Pago</x-slot>
        <x-slot name="button">
          <div class="btn-group float-right" role="group" aria-label="Basic example">          
            @can('payment update')
              <button class="btn btn-sm btn-primary" wire:click="edit()" 
              @if ($bulkDisabled) disabled @endif><i class="fa fa-edit text-eith"></i>
              </button>
            @endcan
            @can('payment create')
            <button class="btn btn-sm btn-primary" wire:click="$set('show', true)">
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
            <x-table.th field="quotas" class="text-center">Cuotas</x-table.th>
            <x-table.th field="typeinterval" class="text-center">Tipo Intervalo</x-table.th>
            <x-table.th field="interval" class="text-center">Intervalo</x-table.th>            
          </x-slot>
          @forelse ($payments as $key => $item)
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
              <x-table.td class="text-center">{{ $item->quotas }}</x-table.td>
              <x-table.td class="text-center">{{ $item->typeinterval }}</x-table.td>
              <x-table.td class="text-center">{{ $item->interval }}</x-table.td>              
            </tr>
          @empty
          <tr>
            <x-table.td colspan="7">
              <x-otros.error-search></x-otros.error-search>
            </x-table.td>              
          </tr>
          @endforelse
        @include('basics::livewire.payment.form')
        </x-table.table>
        <x-slot name="pagination">
          {!! $payments->links() !!}
        </x-slot>
      </x-otros.view-card>
    </div>
  </div>
  
  @push('styles')
  
  @endpush
  @push('scripts')
  
  @endpush