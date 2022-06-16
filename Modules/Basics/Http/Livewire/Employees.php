<?php

namespace Modules\Basics\Http\Livewire;

use App\Traits\TableLivewire;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Basics\Entities\Employee;

class Employees extends Component
{
    use WithPagination;
    use TableLivewire;

    public $identification, $first_name, $last_name, $status, $type_document, $address, $phone; 
    public $cel_phone, $entry_date, $email, $gender, $birth_date, $location_id, $photo_path, $vendedor;

    protected $listeners = ['toggleEmployee', 'showaudit'];       

    public function mount()
    {                   
        $this->model = 'Modules\Basics\Entities\Employee';
        $this->exportable ='App\Exports\EmployeesExport';
    }
    
    protected function rules() 
    {
        return [
            'identification' => ['required', 'numeric', Rule::unique('basic_employees')->ignore($this->selected_id)],
            'first_name' => 'required|string|max:100|min:4',
            'last_name' => 'required|string|max:100|min:4',
            'type_document' => 'required|max:2',
            'address' => 'nullable|max:192',
            'phone' => 'nullable|digits:10',
            'cel_phone' => 'nullable|digits:10',
            'entry_date' => 'nullable|date',
            'email' => ['nullable', 'email', 'max:100', Rule::unique('basic_employees')->ignore($this->selected_id)],
            'vendedor' => 'nullable',            
            'gender' => ['nullable', 'max:1', Rule::in(['M', 'F', 'O'])],
            'birth_date' => 'nullable|date',
            'location_id' => 'nullable',
            'photo_path' => 'nullable'
        ];
    }            

    public function render()
    {
        $this->bulkDisabled = count($this->selectedModel) < 1;

        $employees = new Employee();

        $employees = $employees->QueryTable($this->keyWord, $this->sortField, $this->sortDirection)->paginate(20);

        return view('basics::livewire.employee.view', compact('employees'));
    }

    public function store()
    {   
        can('employee create');

        $validate = $this->validate();    	
        
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

        $validate = $this->validate();

        if ($this->selected_id) {
    		$record = Employee::find($this->selected_id);
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
}
