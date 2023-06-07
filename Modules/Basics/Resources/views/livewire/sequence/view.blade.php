<div class="row">
    <div class="col-12 grid-margin">
      <x-otros.view-card :exportable="$exportable" :audit="$audit">
        <x-slot name="title">Conecutivos</x-slot>
        <x-slot name="button">
          <div class="btn-group float-right" role="group" aria-label="Basic example">
            @can('classification delete')
              <button class="btn btn-sm btn-primary" wire:click.prevent="$emit('destroySequence')" title="Eliminar Registro"
              @if ($bulkDisabled) disabled @endif><i class="fa fa-trash text-eith"></i>
              </button>
            @endcan
            @can('operation toggle')
            <button class="btn btn-sm btn-primary" wire:click.prevent="$emit('toggleItem')" title="Activar o Desactivar Item"
            @if ($bulkDisabled) disabled @endif><i class="fa fa-exclamation text-with"></i>
            </button>
            @endcan
            @can('sequence update')
              <button class="btn btn-sm btn-primary" wire:click="edit()"
              @if ($bulkDisabled) disabled @endif><i class="fa fa-edit text-eith"></i>
              </button>
            @endcan
            @can('sequence create')
              <button class="btn btn-sm btn-primary" wire:click="doubleItem()" title="Duplicar Registro"
              @if ($bulkDisabled) disabled @endif><i class="fa fa-share-alt-square text-eith"></i>
              </button>
            @endcan
            @can('sequence create')
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
            <x-table.th field="id" >#</x-table.th>
            <x-table.th width="80px" field="document">Documento</x-table.th>
            <x-table.th field="document_name" class="text-center">Nombre</x-table.th>
            <x-table.th field="modelo" class="text-center">Modelo</x-table.th>
            <x-table.th width="80px" field="number" class="text-center">Numero</x-table.th>
            <x-table.th field="status" class="text-center">Estado</x-table.th>
          </x-slot>
          @forelse ($sequences as $key => $item)
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
              <td width="80px">{{ $loop->iteration }}</td>
              <td width="80px">{{ $item->document }}</td>
              <td >{{ $item->document_name }}</td>
              <td >{{ $item->modelo }}</td>
              <td width="80px" class="text-right">{{ $item->number }}</td>
              <td class="text-center text-{{ $item->status_color }}">{{ $item->status }}</td>
            </tr>
          @empty
          <tr>
            <x-table.td colspan="7">
              <x-otros.error-search></x-otros.error-search>
            </x-table.td>
          </tr>
          @endforelse
        @include('basics::livewire.sequence.form')
        </x-table.table>
        <x-slot name="pagination">
          {!! $sequences->links() !!}
        </x-slot>
      </x-otros.view-card>
    </div>
  </div>

  @push('styles')

  @endpush
  @push('scripts')
  <script>
    window.livewire.on('destroySequence', (id) => {
          Swal.fire({
              title: 'Estas segro?',
              text: "¡Deseas Eliminar este Consecutivo!",
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