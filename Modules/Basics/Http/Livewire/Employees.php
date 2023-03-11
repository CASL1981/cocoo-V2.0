<?php

namespace Modules\Basics\Http\Livewire;

use App\Traits\TableLivewire;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Basics\Entities\Destination;
use Modules\Basics\Entities\Employee;
use App\Traits\CRUDLivewireTrait;
use Modules\Basics\Http\Requests\RequestEmployee;

class Employees extends Component
{
    use WithPagination;
    use TableLivewire;
    use CRUDLivewireTrait;

    public $identification, $first_name, $last_name, $status, $type_document, $address, $phone; 
    public $cel_phone, $entry_date, $email, $gender, $birth_date, $location_id, $photo_path, $vendedor;

    public $destinations;
    protected $listeners = ['toggleEmployee', 'showaudit'];       

    public function hydrate()
    {
        $this->destinations = Destination::pluck('name', 'costcenter')->toArray();

        $this->permissionModel = 'employee';
        
        $this->messageModel = 'Empleado';    
                        
        $this->model = 'Modules\Basics\Entities\Employee';
        $this->exportable ='App\Exports\EmployeesExport';
    }        

    public function render()
    {
        $employees = new Employee();

        $employees = $employees->QueryTable($this->keyWord, $this->sortField, $this->sortDirection)->paginate(20);

        return view('basics::livewire.employee.view', compact('employees'));
    }

    public function store()
    {   
        can('employee create');

        $requestEmployee = new RequestEmployee();        

        $validate = $this->validate($requestEmployee->rules());        
        
        Employee::create($validate);        
        
        $this->resetInput();        
    	$this->emit('alert', ['type' => 'success', 'message' => 'Empleado creado']);        
    }

    public function edit()
    {   
        can('employee update');

        $record = Employee::findOrFail($this->selected_id);            
                
        $this->identification = $record->identification;
        $this->first_name = $record->first_name;
        $this->last_name = $record->last_name;
        $this->status = $record->status;
        $this->type_document = $record->type_document;
        $this->address = $record->address;
        $this->phone = $record->phone;
        $this->cel_phone = $record->cel_phone;
        $this->entry_date = $record->entry_date;
        $this->email = $record->email;
        $this->vendedor = $record->vendedor;
        $this->gender = $record->gender;
        $this->birth_date = $record->birth_date;
        $this->location_id = $record->location_id;

        $this->show = true;
    }

    public function update()
    {
        can('employee update');

        if ($this->selected_id) {
            //Consultamos el tercero seleccionado
    		$record = Employee::find($this->selected_id);
            
            //validamos el request
            $requestEmployee = new RequestEmployee();        
            $validate = $this->validate($requestEmployee->rules($record));

            //actualizamos el registro seleccionado
            $record->update($validate);

            $this->resetInput();            
    		$this->emit('alert', ['type' => 'success', 'message' => 'Empleado actualizado']);
        }
    }

    public function toggleEmployee()
    {
        can('employee toggle');        

        if (count($this->selectedModel)) {
            //consultamos todos los status y consultamos los modelos de los usuarios seleccionado
            $status = Employee::whereIn('id', $this->selectedModel)->get('status')->toArray();
            $record = Employee::whereIn('id', $this->selectedModel);            
            
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
    
    // Modificamos la funacion del Trait TableLivewire
    public function auditoria()
    {        
        if ($this->selected_id) {
            $this->audit = $this->model::with(['creator', 'editor'])->find($this->selected_id)->toArray();                        
            $this->showauditor = true;
        } else {
            $this->emit('alert', ['type' => 'warning', 'message' => 'Selecciona un registros']);
        }
        
    }
}
