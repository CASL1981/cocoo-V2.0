<div class="row">
    <div class="col-12 grid-margin">
      <x-otros.view-card :exportable="$exportable" :audit="$audit">
        <x-slot name="title">Terceros</x-slot>
        <x-slot name="button">
          <div class="btn-group float-right" role="group" aria-label="Basic example">
            @can('usuario toggle')
                <button class="btn btn-sm btn-primary" wire:click.prevent="$emit('toggleClient')" title="Activar o Desactivar Tercero"
                @if ($bulkDisabled) disabled @endif><i class="fa fa-exclamation text-with"></i>
                </button>                
            @endcan         
            @can('destination update')
              <button class="btn btn-sm btn-primary" wire:click="edit()" title="Editar Tercero"
              @if ($bulkDisabled) disabled @endif><i class="fa fa-edit text-with"></i>
              </button>
            @endcan
            @can('destination create')
            <button class="btn btn-sm btn-primary" wire:click="$set('show', true)" title="Adicionar Tercero">
                <i class="fa fa-plus text-with"></i>
            </button>
            @endcan             
          </div>
        </x-slot>
        <x-table.table :audit="$audit">
          <x-slot name="head" model="$destinations">
            <th class="p-2">
              <div class="form-check form-check-flat form-check-primary" >
                  <label class="form-check-label text-danger" style="width:10">
                  <input type="checkbox" class="form-check-input" wire:model="selectAll">
                  <i class="input-helper"></i></label>
              </div>                      
            </th>
            <x-table.th weight="80px" field="id">#</x-table.th>
            <x-table.th field="identification">Identificación</x-table.th>
            <x-table.th field="first_name">Nombres</x-table.th>
            <x-table.th field="last_name">Apellidos</x-table.th>
            <x-table.th field="client_name">Nombre Tercero</x-table.th>
            <x-table.th field="type_document">TD</x-table.th>
            <x-table.th field="type_document">Estado</x-table.th>
            <x-table.th field="address">Dirección</x-table.th>
            <x-table.th field="phone">Telefono</x-table.th>
            <x-table.th field="cel_phone">Celular</x-table.th>
            <x-table.th field="entry_date">F. Ing.</x-table.th>
            <x-table.th field="email">Email</x-table.th>
            <x-table.th field="gender">Sex</x-table.th>
            <x-table.th field="gender">Tipo</x-table.th>
            <x-table.th field="birth_date">F. Nac.</x-table.th>
            <x-table.th field="limit">Cupo</x-table.th>
            <x-table.th field="vendedor_id">Vendedor</x-table.th>
            <x-table.th field="pricelist_id">Lista Precio</x-table.th>
            <x-table.th field="shoppingcontact">Contacto Compra</x-table.th>
            <x-table.th field="conditionpayment_id">Condición Pago</x-table.th>
          </x-slot>
          @forelse ($clients as $key => $item)
            <tr>
              <td class="p-1">                  
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
              <x-table.td>{{ $item->id }}</x-table.td>
              <x-table.td>{{ $item->identification }}</x-table.td>
              <x-table.td>{{ $item->first_name }}</x-table.td>
              <x-table.td>{{ $item->last_name }}</x-table.td>
              <x-table.td>{{ $item->client_name }}</x-table.td>
              <x-table.td>{{ $item->type_document }}</x-table.td>              
              <td><label class="text-{{ $item->status_color }}">{{ $item->status ? 'Activo' : 'Inacivo' }}</label></td>
              <x-table.td>{{ $item->address }}</x-table.td>
              <x-table.td>{{ $item->phone }}</x-table.td>
              <x-table.td>{{ $item->cel_phone }}</x-table.td>
              <x-table.td>{{ $item->entry_date }}</x-table.td>
              <x-table.td>{{ $item->email }}</x-table.td>
              <x-table.td>{{ $item->gender }}</x-table.td>
              <x-table.td>{{ $item->type }}</x-table.td>
              <x-table.td>{{ $item->birth_date }}</x-table.td>
              <x-table.td>{{ $item->limit }}</x-table.td>
              <x-table.td>{{ $item->vendedor_id }}</x-table.td>
              <x-table.td>{{ $item->pricelist_id }}</x-table.td>
              <x-table.td>{{ $item->shoppingcontact }}</x-table.td>
              <x-table.td>{{ $item->conditionpayment_id }}</x-table.td>
            </tr>
          @empty
          <tr>
            <x-table.td colspan="7">
              <x-otros.error-search></x-otros.error-search>
            </x-table.td>              
          </tr>
          @endforelse
        @include('basics::livewire.client.form')    
        </x-table.table>
        <x-slot name="pagination">
          {!! $clients->links() !!}
        </x-slot>
      </x-otros.view-card>
    </div>
  </div>
  
  @push('styles')

  @endpush
  @push('scripts')
   
  @endpush