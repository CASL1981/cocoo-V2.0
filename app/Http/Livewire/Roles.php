<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Traits\TableLivewire;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    use WithPagination;
    use TableLivewire;

    public $name;    
    public $role;    

    protected $listeners = ['deleteRole'];

    protected function rules() 
    {
        return [
            'name' => 'required|min:3|max:100'
        ];
    }
    
    public function render()
    {
        
        $this->bulkDisabled = $this->selectedModelRadio < 1;

        $roles = Role::search('name', $this->keyWord)        
        ->orderBy($this->sortField, $this->sortDirection)
        ->paginate(10);        

        $roles = $roles->each(function($role){
            $role->count_user = User::role($role->name)->count();
        });

        return view('livewire.role.view', compact('roles'));
    }

    public function store()
    {
        $this->show = true;
        $validate = $this->validate();    	
        
        Role::create($validate);
        
        
        $this->resetInput();        
    	$this->emit('alert', ['type' => 'success', 'message' => 'Role creado']);
        $this->emit('role_id', 0);
    }

    public function edit()
    {        
        $record = Role::findOrFail($this->selected_id);
        
    	$this->name = $record->name;

        $this->show = true;
    }

    public function update()
    {
        $validate = $this->validate();

        if ($this->selected_id) {
    		$record = Role::find($this->selected_id);
            $record->update($validate);

            $this->resetInput();            
    		$this->emit('alert', ['type' => 'success', 'message' => 'Role actualizado']);
        }
    }

    public function deleteRole()
    {
        if ($this->selected_id ) {
            $role = Role::find($this->selected_id);
            //validamos la cantidad de usuarios asignados al Role
            $roles = User::role($role->name)->get();
            if(!$roles->count())
            {
                $this->emit('alert', ['type' => 'success', 'message' => 'Role Eliminado']);
                $role->delete();
            }else{
                $this->emit('alert', ['type' => 'warning', 'message' => 'Role no Eliminado asignado a usuarios']);
            }            
        }
    }
}
