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

        $product = $this->model::find($this->selected_id);
        if($product) {
            $product->update([ 'status' => 'Eliminado' ]); //actualizamos el estado de los modelos
            $product->delete();
            $this->resetInput();
            $this->emit('alert', ['type' => 'success', 'message' => $this->messageModel . ' Eliminada']);            
        } else {
            $this->resetInput();
            $this->emit('alert', ['type' => 'warning', 'message' => $this->messageModel . ' ya esta eliminado no se puede Eliminar']);
        }        
    
    }
    public function processItem()
    {
        can($this->permissionModel . ' delete');

        $product = $this->model::find($this->selected_id);
        $status = $this->model::whereIn('id', $this->selectedModel)->get('status')->toArray();
        
        if($product && !$status[0]['status'] === 'Inactivo') {
            $product->update([ 'status' => 'Procesado' ]); //actualizamos el estado de los modelos            
            $this->resetInput();
            $this->emit('alert', ['type' => 'success', 'message' => $this->messageModel . ' Eliminada']);            
        } else {
            $this->resetInput();
            $this->emit('alert', ['type' => 'warning', 'message' => $this->messageModel . ' ya esta eliminado o inactiva, no se puede Procesar']);
        }        
    }

    public function reverseItem()
    {
        can($this->permissionModel . ' delete');

        // $product = $this->model::find($this->selected_id);
        // $status = $this->model::whereIn('id', $this->selectedModel)->get('status')->toArray();
        $product = $this->model::withTrashed()->find($this->selected_id);
        // dd($product->deleted_by);
        if($product->deleted_by) {
            $product->update([ 'deleted_bu' => NULL, 'status' => 'Activo' ]); //actualizamos el estado de los modelos
            $product->restore(); //reversamos la eliminación con softdelete
            $this->resetInput();
            $this->emit('alert', ['type' => 'success', 'message' => $this->messageModel . ' Activa']);            
        } else {
            $this->resetInput();
            $this->emit('alert', ['type' => 'warning', 'message' => $this->messageModel . ' no esta eliminado']);
        }        
    }

    public function toggleItem()
    {
        can($this->permissionModel . ' toggle');        

        if (count($this->selectedModel)) {
            //consultamos todos los status y consultamos los modelos de los item seleccionadoa
            $status = $this->model::whereIn('id', $this->selectedModel)->get('status')->toArray();
            $record = $this->model::whereIn('id', $this->selectedModel);            
            
            if(!$status){
                $this->resetInput();
                return $this->emit('alert', ['type' => 'warning', 'message' => 'Item eliminado no se puede cambiar']);
            };

            if($status[0]['status'] === 'Activo') {
                $record->update([ 'status' => 'Inactivo' ]); //actualizamos los modelos
                
                $this->selectedModel = []; //limpiamos todos los item seleccionados
                $this->selectAll = false;
            } else {
                $record->update([ 'status' => 'Activo' ]);                
                $this->selectedModel = [];
                $this->selectAll = false;
            }
        } else {
            $this->emit('alert', ['type' => 'warning', 'message' => 'Selecciona un Item']);
        }
    }
}