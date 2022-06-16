<?php

namespace App\Traits;

use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;
trait TableLivewire
{

    public $sortField = 'id', $sortDirection = 'desc'; //variables de ordenamiento
    public $selectedModel = [];
    public $selectedModelRadio = 0;
    public $selectAll = false;
    public $bulkDisabled = true;
    public $selected_id;
    public $keyWord;
    public $show = false; //varible que controla el modal
    public $showauditor = false; //varible que controla el modal de auditoria
    public $model; //modelo de la tabla
    public $exportable; //clase exportable de laravel excel
    public $audit = []; //variable de auditoria
    
    protected $paginationTheme = 'bootstrap';
    
    public function sortBy($field)
    {        
        $this->sortDirection = $this->sortField === $field
        ? $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc'
        : 'asc';
        
        $this->sortField = $field;
    }
    
    
    public function updatingKeyWord()
    {
        $this->resetPage();
    }
    
    function method()
    {
        return $this->selected_id ? $this->update() : $this->store();
    }
    
    public function cancel()
    {
        $this->resetInput();
    }

    public function closed()
    {
        $this->cancel();
        $this->show = false;
    }
    
    private function resetInput()
    {		
        $this->resetErrorBag();
        $this->resetValidation();        
        $this->resetExcept(['model', 'exportable', 'keyWord']);
    }
    
    public function updatedSelectAll($value)
    {
        $value ? $this->selectedModel = $this->model::pluck('id') : $this->selectedModel = [];
    }
    
    public function export($ext)
    {        
        abort_if(!in_array($ext, ['csv', 'xlsx', 'pdf']), Response::HTTP_NOT_FOUND);
        
        $query = new $this->model;
        
        $query = $query->QueryTable($this->keyWord, $this->sortField, $this->sortDirection)->get();

        return Excel::download(new $this->exportable($query), 'filename.' . $ext);
    }

    public function auditoria()
    {        
        if ($this->selected_id) {
            $this->audit = $this->model::with(['creator', 'editor'])->find($this->selected_id)->toArray();                        
            $this->showauditor = true;
        } else {
            $this->emit('alert', ['type' => 'warning', 'message' => 'Selecciona un registros']);
        }
        
    }
    
    public function showaudit()
    {
        $this->showauditor = false;
    }
}