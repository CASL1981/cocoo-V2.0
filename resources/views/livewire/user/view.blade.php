<div>
  <div class="card">    
    <div class="card-body">
      <div class="row">
        <div class="col-sm-12 col-md-4">
          <h4 class="card-title">Usuarios</h4>
        </div>
        <div class="col-md-4">
          <label class="w-100">
            <input wire:model='keyWord' type="search" class="form-control p-2" placeholder="Buscar">
          </label>
        </div>
        <div class="col-sm-12 col-md-4">
          <div class="btn-group float-right" role="group" aria-label="Basic example">
            @can('usuario toggle')
                <button class="btn btn-sm btn-primary" wire:click.prevent="$emit('toggleUser')" title="Activar o Desactivar Usuario"
                @if ($bulkDisabled) disabled @endif><i class="fa fa-exclamation text-with"></i>
                </button>                
            @endcan
            @can('usuario update')
                <button class="btn btn-sm btn-primary" wire:click="edit()" title="Modificar Usuario"
                @if ($bulkDisabled) disabled @endif><i class="fa fa-edit text-with"></i>
                </button>                    
            @endcan
            @can('usuario create')
              <button class="btn btn-sm btn-primary " wire:click="$emit('ShowModalUser')" title="Adicionar Registro">
                <i class="fa fa-plus text-with"></i>
              </button>
            @endcan
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table id="users-list" class="table">
              <thead>
                <tr>
                    <th class="p-2">
                      <div class="form-check form-check-flat form-check-primary" >
                          <label class="form-check-label text-danger" style="width:10">
                          <input type="checkbox" class="form-check-input" wire:model="selectAll">
                          <i class="input-helper"></i></label>
                      </div>                      
                    </th>
                    <x-table.th field="id" :sortField="$sortField" :sortDirection="$sortDirection">#</x-table.th>
                    <x-table.th field="firstname" :sortField="$sortField" :sortDirection="$sortDirection">Nombres</x-table.th>
                    <x-table.th field="lastname" :sortField="$sortField" :sortDirection="$sortDirection">Apellidos</x-table.th>
                    <x-table.th field="email" :sortField="$sortField" :sortDirection="$sortDirection">Email</x-table.th>
                    <x-table.th field="area" :sortField="$sortField" :sortDirection="$sortDirection">Area</x-table.th>
                    <x-table.th field="status" :sortField="$sortField" :sortDirection="$sortDirection">Status</x-table.th>
                    <x-table.th field="role_id" :sortField="$sortField" :sortDirection="$sortDirection">Role</x-table.th>
                    <x-table.th field="destination_id" :sortField="$sortField" :sortDirection="$sortDirection">Centro Costo</x-table.th>
                    <th>Foto</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $item)
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
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->firstname }}</td>
                    <td>{{ $item->lastname }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->area }}</td>
                    <td><label class="text-{{ $item->status_color }}">{{ $item->status ? 'Activo' : 'Inacivo' }}</label></td>
                    <td>{{ $item->roles()->first()->name ?? 'N/A'}}</td>
                    <td>{{ $item->destination_id }}</td>
                    <td class="py-1">
                      <img src="{{ asset($item->image_user) }}" alt="imagen">
                    </td>                    
                  </tr>                    
                @endforeach
              </tbody>
            </table>
          </div>
          {{ $users->links() }}
        </div>
      </div>
    </div>
  </div>
  @include('livewire.user.form')
</div>

@push('styles')
    
@endpush

@push('scripts')
<script>
  window.livewire.on('ShowModalUser', () => {
    $('#ModalUser').modal('show')
  });
</script>
@endpush