<?php

namespace App\Http\Livewire;

use App\Models\Profile;
use App\Models\User;
use App\Traits\TableLivewire;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Modules\Basics\Entities\Destination;
use Spatie\Permission\Models\Role;

class Users extends Component
{
    use WithPagination;
    use TableLivewire;
    use WithFileUploads;
    
    public $firstname, $lastname, $area, $email, $status, $role_id, $destination_id, $profile_photo , $identificador;
    public $profile_photo_temp;

    public $destinations = [];

    protected $listeners = ['toggleUser'];

    public function mount()
    {
        $this->identificador = rand();  
        $this->destinations =  Destination::pluck('name', 'costcenter')->toArray();     
    }

    protected function rules() 
    {
        return [
            'firstname'      => 'required|min:3|max:100',
            'lastname'       => 'required|min:3|max:100',            
            'email'          => ['required', 'max:100', Rule::unique('users')->ignore($this->selected_id)],
            'area'           => 'required|in:Administrativa,Comercial,Farmacia',
            'status'         => 'nullable',
            'role_id'        => 'nullable',
            'destination_id' => 'nullable',
            'profile_photo' => 'nullable|max:2048', // 2MB Max
        ];
    }

    public function render()
    {
        $this->bulkDisabled = count($this->selectedModel) < 1;
        
        $users = User::search('firstname', $this->keyWord)
        ->search('lastname', $this->keyWord)
        ->search('status', $this->keyWord)
        ->search('email', $this->keyWord)                        
        ->orderBy($this->sortField, $this->sortDirection)
        ->with('roles')
        ->paginate(10);      

        $roles = Role::all();
        
        return view('livewire.user.view', compact('users', 'roles'));
    }

    public function store()
    {
        can('usuario create');
        $validate = $this->validate();
    	
        $fillable = [
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'status' => false, // se crea inactivo
        ];
        
        $validate = array_merge($validate, $fillable);
        $user = User::create($validate);
        //Asignamos el role seleccinado
        $user->assignRole($this->role_id);

        //Creamos el perfil
        $perfil = new Profile();
        $perfil->create(['user_id' => $user->id]);

        // $this->resetInput();
        // $this->emit('CloseModal', ['modalName' => '#ModalUser']); // Close model to using to jquery
        $this->cancel();
    	$this->emit('alert', ['type' => 'success', 'message' => 'Usuario creado']);
    }

    public function edit()
    {
        can('usuario update');
        $this->emit('ShowModalUser');
        $record = User::findOrFail($this->selected_id);
        
    	$this->firstname = $record->firstname;
    	$this->lastname = $record-> lastname;
    	$this->email = $record->email;
    	$this->area = $record-> area;
    	$this->status = $record-> status;
    	$this->role_id = $record-> role_id;
    	$this->destination_id = $record-> destination_id;
    	$this->profile_photo_temp = $record-> profile_photo;
    }

    public function cancel()
    {
        $this->resetInput();
        $this->emit('CloseModal', ['modalName' => '#ModalUser']); // Close model to using to jquery
    }

    public function update()
    {
        can('usuario update');
        $validate = $this->validate();        
        if ($this->selected_id) {
            
    		$record = User::find($this->selected_id);            

            if($validate['profile_photo']){
                $this->removeImage($record->profile_photo);
                $photo = $this->profile_photo->store('profile_photo', 'public');                
                $fillable = [                
                    'status' => $this->status, // se asigna el status actual
                    'profile_photo' => $photo, //guardamos la url de la imagen
                ];
            }else{
                $fillable = [                
                    'status' => $this->status, // se asigna el status actual
                    'profile_photo' => $this->profile_photo_temp, // se asigna el status actual
                ];
            }
            

            //adicionamos el resultado del campo status al request
            $validate = array_merge($validate, $fillable);

            $record->update($validate);
            
            //Asignamos el rol seleccionado
            $record->syncRoles($this->role_id);
            
            $this->resetInput();
            $this->identificador = rand();
            $this->emit('CloseModal', ['modalName' => '#ModalUser']); // Close model to using to jquery
    		$this->emit('alert', ['type' => 'success', 'message' => 'Usuario actualizado']);
        }
        
    }

    public function toggleUser()
    {
        can('usuario toggle');        

        if (count($this->selectedModel)) {
            //consultamos todos los status y consultamos los modelos de los usuarios seleccionado
            $status = User::whereIn('id', $this->selectedModel)->get('status')->toArray();
            $record = User::whereIn('id', $this->selectedModel);            
            
            if($status[0]['status']) {
                $record->update([ 'status' => false ]); //actualizamos los modelos
                
                $this->selectedModel = []; //limpiamos todos los usuarios seleccionados
                $this->selectAll = false;
            } else {
                $record->update([ 'status' => true ]);
                
                $this->selectedModel = [];
                $this->selectAll = false;
            }
        } else {
            $this->emit('alert', ['type' => 'warning', 'message' => 'Selecciona un Usuario']);
        }
    }

    public function updatedSelectAll($value)
    {
        $value ? $this->selectedModel = User::pluck('id') : $this->selectedModel = [];
    }

    public function removeImage($profile_photo)
    {
        if(! $profile_photo){
            return;
        }       
        
        if(Storage::disk('public')->exists($profile_photo)){
            Storage::disk('public')->delete($profile_photo);
        }
    }
}
