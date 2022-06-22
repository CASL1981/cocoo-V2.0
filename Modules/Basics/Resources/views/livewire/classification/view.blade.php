<div class="row">
    <div class="col-12 grid-margin">
      <x-otros.view-card :exportable="$exportable" :audit="$audit">
        <x-slot name="title">Clasificaciones</x-slot>
        <x-slot name="button">
          <div class="btn-group float-right" role="group" aria-label="Basic example">
            @can('classification delete')
              <button class="btn btn-sm btn-primary" wire:click.prevent="$emit('destroyClassification')" title="Eliminar Registro"
              @if ($bulkDisabled) disabled @endif><i class="fa fa-trash text-eith"></i>
              </button>
            @endcan
            @can('classification update')
              <button class="btn btn-sm btn-primary" wire:click="edit()" title="Modificar Registro"
              @if ($bulkDisabled) disabled @endif><i class="fa fa-edit text-eith"></i>
              </button>
            @endcan
            @can('classification create')
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
            <x-table.th field="code">Codigo</x-table.th>
            <x-table.th field="level" class="text-center">Nivel</x-table.th>
            <x-table.th field="parent" class="text-center">Padre</x-table.th>
            <x-table.th field="name">Descripción</x-table.th>
            <x-table.th field="impute" class="text-center">Imputable</x-table.th>
          </x-slot>
          @forelse ($classifications as $key => $item)
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
              <x-table.td>{{ $item->code }}</x-table.td>
              <x-table.td class="text-center">{{ $item->level }}</x-table.td>
              <x-table.td class="text-center">{{ $item->parent }}</x-table.td>
              <x-table.td>{{ $item->name }}</x-table.td>
              <x-table.td class="text-center">{{ $item->impute }}</x-table.td>
            </tr>
          @empty
          <tr>
            <x-table.td colspan="7">
              <x-otros.error-search></x-otros.error-search>
            </x-table.td>              
          </tr>
          @endforelse
        @include('basics::livewire.classification.form')
        </x-table.table>
        <x-slot name="pagination">
          {!! $classifications->links() !!}
        </x-slot>
      </x-otros.view-card>
    </div>
  </div>
  
  @push('styles')
  
  @endpush
  @push('scripts')
  <script>
    window.livewire.on('destroyClassification', (id) => {
          Swal.fire({
              title: 'Estas segro?',
              text: "¡Deseas Eliminar esta Clasificación!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, Eliminala!'
              }).then((result) => {
              if (result.isConfirmed) {
                  Livewire.emit('deleteClassification')
              }});
          });
  </script>
  @endpush