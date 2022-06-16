<div class="row">
  <div class="col-12 grid-margin">
    <x-otros.view-card :exportable="$exportable" :audit="$audit">
      <x-slot name="title">Centros de Costos</x-slot>
      <x-slot name="button">
        <div class="btn-group float-right" role="group" aria-label="Basic example">          
          @can('destination update')
            <button class="btn btn-sm btn-primary" wire:click="edit()" 
            @if ($bulkDisabled) disabled @endif><i class="fa fa-edit text-with"></i>
            </button>
          @endcan
          @can('destination create')
          <button class="btn btn-sm btn-primary" wire:click="$set('show', true)">
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
          <x-table.th field="costcenter">CC</x-table.th>
          <x-table.th field="name">Descripción</x-table.th>
          <x-table.th field="address">Dirección</x-table.th>
          <x-table.th field="phone">Telefono</x-table.th>
          <x-table.th field="location">Ubicación</x-table.th>
          <x-table.th field="minimun">Minimo</x-table.th>
          <x-table.th field="maximun">Maximo</x-table.th>          
        </x-slot>
        @forelse ($destinations as $key => $item)
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
            <x-table.td>{{ $item->costcenter }}</x-table.td>
            <x-table.td>{{ $item->name }}</x-table.td>
            <x-table.td>{{ $item->address }}</x-table.td>
            <x-table.td>{{ $item->phone }}</x-table.td>
            <x-table.td>{{ $item->location }}</x-table.td>
            <x-table.td>{{ $item->minimun }}</x-table.td>
            <x-table.td>{{ $item->maximun }}</x-table.td>
          </tr>
        @empty
        <tr>
          <x-table.td colspan="7">
            <x-otros.error-search></x-otros.error-search>
          </x-table.td>              
        </tr>
        @endforelse
      @include('basics::livewire.destination.form')    
      </x-table.table>
      <x-slot name="pagination">
        {!! $destinations->links() !!}
      </x-slot>
    </x-otros.view-card>
  </div>
</div>

@push('styles')

@endpush
@push('scripts')
<script>
  $(document).ready(function() {
    $('#table-jsquery').DataTable({
      "paging":   false,
      "ordering": false,
      "info":     false,
      "autoWidth": true,
      "scrollX": true,
      // "scrollCollapse": false,
      "scrollY": 300,
      "searching": false
    });
  });

</script>

@endpush