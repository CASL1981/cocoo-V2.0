<x-otros.modal wire:model="showSearch">
    <x-slot name="title">Busqueda Ordenes</x-slot>
    <div class="card-body">
      <form>
        <div class="form-group">
          <div class="input-group">
            <input type="text" class="form-control" 
            placeholder="Numero de Orden" aria-label="Numero de orden"
            wire:model.defer="searchOrder">
            <div class="input-group-append">
              <button class="btn btn-sm btn-primary" type="button" wire:click="closedModalSearch()">Buscar</button>
            </div>
          </div>
        </div>
      </form>
    </div>    
</x-otros.modal>