<?php

namespace App\Traits;

use Modules\Orders\Entities\Operation;

trait CRUDLivewireTrait
{
    public $permissionModel;
    
    public $messageModel;

    public function store()
    {   
        can($this->permissionModel . ' create');

        $validate = $this->validate();    	
        
        $this->model::create($validate);
        
        $this->resetInput();        
    	$this->emit('alert', ['type' => 'success', 'message' => $this->messageModel . ' creada']);
        
    }

    public function doubleItem()
    {   
        can($this->permissionModel . ' create');

        $this->edit();
        $this->store() ;
    }

    public function update()
    {
        can($this->permissionModel . ' update'); 

        $validate = $this->validate();

        if ($this->selected_id) {
    		$record = $this->model::find($this->selected_id);
            $record->update($validate);

            $this->closed();
    		$this->emit('alert', ['type' => 'success', 'message' => $this->messageModel . ' actualizada']);
        }
    }

    public function deleteItem()
    {
        can($this->permissionModel . ' delete');

        $status = $this->model::whereIn('id', $this->selectedModel)->get('status')->toArray();

        if($status[0]['status'] <> 'Open'){
            $this->resetInput();
            return $this->emit('alert', ['type' => 'warning', 'message' => 'Item no se encuentra en estado activo']);
        };

        $product = $this->model::find($this->selected_id);
        if($product) {
            $product->update([ 'status' => 'Cancelled' ]); //actualizamos el estado de los modelos
            $product->delete();
            $this->resetInput();
            $this->emit('alert', ['type' => 'success', 'message' => $this->messageModel . ' Anulado']);            
        } else {
            $this->resetInput();
            $this->emit('alert', ['type' => 'warning', 'message' => $this->messageModel . ' ya esta Anulado no se puede Eliminar']);
        }        
    
    }
    public function processItem()
    {
        can($this->permissionModel . ' process');

        $modelo = $this->model::find($this->selected_id);
        $status = $this->model::withTrashed()->whereIn('id', $this->selectedModel)->get('status')->toArray();
        
        if($modelo && $status[0]['status'] === 'Open') {
            $modelo->update([ 'status' => 'Completed' ]); //actualizamos el estado de los modelos            
            $this->resetInput();
            $this->emit('alert', ['type' => 'success', 'message' => $this->messageModel . ' Cmpletada']);
        } else {
            $this->resetInput();
            $this->emit('alert', ['type' => 'warning', 'message' => $this->messageModel . ' no esta abierta o en proceso, no se puede Procesar']);
        }        
    }

    public function reverseItem()
    {
        can($this->permissionModel . ' reverse');
        
        $product = $this->model::withTrashed()->find($this->selected_id);
        
        if($product->deleted_by || $product->status == 'Completed') {
            $product->update([ 'deleted_by' => NULL, 'status' => 'Open' ]); //actualizamos el estado de los modelos
            $product->restore(); //reversamos la eliminación con softdelete
            $this->resetInput();
            $this->emit('alert', ['type' => 'success', 'message' => $this->messageModel . ' Activa']);            
        } else {
            $this->resetInput();
            $this->emit('alert', ['type' => 'warning', 'message' => $this->messageModel . ' no esta Anulado o Procesada']);
        }        
    }

    public function toggleItem()
    {
        can($this->permissionModel . ' toggle');        

        if (count($this->selectedModel)) {
            //consultamos todos los status y consultamos los modelos de los item seleccionadoa
            $status = $this->model::whereIn('id', $this->selectedModel)->get('status')->toArray();
            $record = $this->model::whereIn('id', $this->selectedModel);            
            
            if(!$status || $status[0]['status'] == 'Completed'){
                $this->resetInput();
                return $this->emit('alert', ['type' => 'warning', 'message' => 'Item Anulado o No se encuentra en estado activo no se puede cambiar']);
            };
            
            
            if($status[0]['status'] === 'Open' && $status[0]['status'] <> 'Completed') {
                
                $record->update([ 'status' => 'Blocked' ]); //actualizamos los modelos
                
                $this->selectedModel = []; //limpiamos todos los item seleccionados
                $this->selectAll = false;
            } else {
                
                $record->update([ 'status' => 'Open' ]);                
                $this->selectedModel = [];
                $this->selectAll = false;
            }
        } else {
            $this->emit('alert', ['type' => 'warning', 'message' => 'Selecciona un Item']);
        }
    }    
}