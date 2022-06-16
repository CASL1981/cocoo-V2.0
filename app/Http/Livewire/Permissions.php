<?php

namespace App\Http\Livewire;

use App\Traits\TableLivewire;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Permissions extends Component
{
    use WithPagination;
    use TableLivewire;

    public $name;
    public $role;    
    public $permission_check = [];    

    protected $listeners = ['role_id' => 'selectedId'];

    public function selectedId($id)
    {        
        $this->selected_id = $id;
        $this->render();
    }
    
    public function render()
    {
        $this->bulkDisabled = count($this->selectedModel) < 1;

        $permissions = Permission::search('name', $this->keyWord)        
        ->orderBy($this->sortField, $this->sortDirection)
        ->paginate(10);        

        if ($this->selected_id) {

            $this->role = Role::findOrFail($this->selected_id);
            
            $havePermission = $this->role->permissions()->get();

            $permissions->map(function($permission) use ($havePermission) {
                if($havePermission->contains($permission))            {
                    $permission->check = true;                    
                } else {
                    $permission->check = false;                    
                }
            });            
        }

        return view('livewire.permission.view', compact('permissions'));
    }  

    public function addPermisssionKey($permission)
    {   
        if($this->selected_id){
            if (!$this->role->hasPermissionTo($permission)) {                
                $this->role->givePermissionTo($permission);            
            } else {                
                $this->role->revokePermissionTo($permission);
            }
        } else {
            $this->emit('alert', ['type' => 'warning', 'message' => 'Selecciona un Role']);
        }
    }
}
