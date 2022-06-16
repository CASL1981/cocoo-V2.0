<div>
  <x-otros.view-card>
    <x-slot name="title">Roles</x-slot>
    <x-slot name="button">
      <div class="btn-group float-right" role="group" aria-label="Basic example">
        @can('role delete')
          <button class="btn btn-sm btn-primary" wire:click.prevent="$emit('destroyRole')" 
              @if ($bulkDisabled) disabled @endif><i class="fa fa-trash text-with"></i>
          </button>
        @endcan
        @can('role update')
          <button class="btn btn-sm btn-primary" wire:click="edit()" 
          @if ($bulkDisabled) disabled @endif><i class="fa fa-edit text-with"></i>
          </button>
        @endcan
        @can('role create')
        <button class="btn btn-sm btn-primary" wire:click="$set('show', true)">
            <i class="fa fa-plus text-with"></i>
        </button>
        @endcan
      </div>
    </x-slot>
    <div class="col-12">
      <div class="table-responsive tableFixHead">
        <table id="users-list" class="table">
          <thead> 
            <th class="p-2"></th>
            <x-table.th weight="50px" field="id" :sortField="$sortField" :sortDirection="$sortDirection">#</x-table.th>
            <x-table.th field="name" :sortField="$sortField" :sortDirection="$sortDirection">Nombre</x-table.th>
            <th class="text-center">Usuarios x Role</th>
          </thead>
          <tbody>
            @forelse ($roles as $row)
              <tr>
                <div class="form-group">
                    <x-table.td class="p-1 w-2">
                      <div class="form-check">                   
        
                        <div class="form-check form-check-info">
                          <label class="form-check-label">                        
                            <input type="radio" class="form-check-input" name="selectedModelRadio"
                            wire:model="selectedModelRadio" 
                            value="{{$row->id}}"
                            wire:click="$set('selected_id',{{$row->id}})"
                            wire:change="$emit('role_id', {{$row->id}})"                        
                            ><i class="input-helper"></i></label>
                        </div>
                      </div>
                    </x-table.td>
                    <x-table.td weight="50px">{{ $row->id }}</x-table.td>                
                    <x-table.td>{{ $row->name }}</x-table.td>
                    <x-table.td class="text-center">{{ $row->count_user }}</x-table.td>                
                </div>                
              </tr>
            @empty
            <tr>
              <x-table.td colspan="7">
                <x-otros.error-search></x-otros.error-search>
              </x-table.td>              
            </tr>
            @endforelse
            @include('livewire.role.form')    
          </tbody>        
        </table>
      </div>    
    </div>
    <x-slot name="pagination">
      {{-- {!! $roles->links() !!} --}}
    </x-slot>
  </x-otros.view-card>
</div>
  
@push('styles')
    
@endpush
  
@push('scripts')
<script>
  window.livewire.on('destroyRole', (id) => {
        Swal.fire({
            title: 'Estas segro?',
            text: "¡Deseas Eliminar este Role!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminalo!'
            }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('deleteRole')
            }});
        });
</script>
@endpush