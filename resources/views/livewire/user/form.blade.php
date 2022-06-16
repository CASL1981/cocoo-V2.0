<div wire:ignore.self class="modal fade show" id="ModalUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(205, 93, 221); color:#fff;">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="firstname">Nombres</label>
                        <input type="text" wire:model="firstname" class="form-control form-control-sm defaultconfig-3" maxlength="100">
                        @error('firstname') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group col-md-3">
                      <label for="lasstname">Apellidos</label>
                      <input type="text" wire:model="lastname" class="form-control form-control-sm defaultconfig-3" maxlength="100">
                      @error('lastname') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="area">Role</label>
                          <select class="form-control" wire:model="role_id" name="role_id" id="role_id" >
                              <option value="">-- Seleccione --</option>                              
                              @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                              @endforeach
                          </select>
                          @error('role_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="area">Area</label>
                          <select class="form-control" wire:model="area" name="area" id="area" >
                              <option value="">-- Seleccione --</option>
                              <option value="Administrativa">Administrativa</option>
                              <option value="Comercial">Comercial</option>
                              <option value="Farmacia">Farmacia</option>
                          </select>
                          @error('area') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-5">
                      <label for="lasstname">Email</label>
                      <input type="text" wire:model="email" class="form-control form-control-sm defaultconfig-3" maxlength="100">
                      @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                  </div>                                    
                  <div class="form-group col-md-3">
                      <label for="destination_id">Centro de Costos</label>
                      {{-- <select class="form-control" wire:model="destination_id" name="destination_id" id="destination_id" >
                          <option value="">-- Seleccione --</option>
                          <option value="1">Oficina Principal</option>
                          <option value="1100">Farmacia Valencia</option>
                          <option value="1200">Farmacia Lorica</option>
                          <option value="1300">Farmacia Montelibano</option>
                      </select> --}}
                      <x-form.select wire:model="destination_id" :options="$destinations"></x-form.select>
                      @error('destination_id') <span class="error text-danger">{{ $message }}</span> @enderror
                  </div>
                  <div class="form-group col-md-4">
                    <label>Foto Perfil</label>
                    <input type="file" wire:model="profile_photo" id="{{$identificador}}" class="file-upload-default">
                    <div class="input-group col-xs-12">
                      <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image" wire:model="profile_photo_temp">
                      <span class="input-group-append">
                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                      </span>
                    </div>
                    @error('profile_photo') <span class="error text-danger">{{ $message }}</span> @enderror
                  </div>
                </div>
            </div>                                         
        </form>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" wire:click.prevent="cancel()">Cerrar</button>
        <button type="button" class="btn btn-primary" wire:click.prevent="method()">Guardar</button>
      </div>
    </div>
  </div>
</div>