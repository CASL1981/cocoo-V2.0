<?php

namespace Modules\Basics\Http\Livewire;

use App\Traits\TableLivewire;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Basics\Entities\Client;
use Modules\Basics\Entities\Employee;

class Clients extends Component
{
    use WithPagination;
    use TableLivewire;

    public $identification, $first_name, $last_name, $client_name, $status, $type_document, $address, $phone; 
    public $cel_phone, $entry_date, $email, $gender, $type, $birth_date, $limit, $vendedor_id, $typeprice_id;
    public $shoppingcontact, $conditionpayment_id;
    public $vendedores;    

    protected $listeners = ['toggleClient', 'showaudit'];
    
    public function mount()
    {
        $this->vendedores = Employee::where('vendedor', true)->where('status', true)
                        ->pluck('first_name', 'identification')->toArray();
                        
        $this->model = 'Modules\Basics\Entities\Client';
        $this->exportable ='App\Exports\ClientsExport';
    }

    protected function rules() 
    {
        return [
            'identification' => ['required', 'numeric', Rule::unique('basic_clients')->ignore($this->selected_id)],
            'first_name' => 'nullable|string|max:100|min:4',
            'last_name' => 'nullable|string|max:100|min:4',
            'client_name' => 'nullable|string|max:100|min:4',
            'type_document' => 'nullable|max:3',
            'address' => 'nullable|max:192',
            'phone' => 'nullable|digits:10',
            'cel_phone' => 'nullable|digits:10',
            'entry_date' => 'nullable|date',            
            'email' => ['nullable', 'email', 'max:100', Rule::unique('basic_clients')->ignore($this->selected_id)],            
            'gender' => ['nullable', 'max:1', Rule::in(['M', 'F', 'O'])],
            'type' => ['nullable', 'max:10', Rule::in(['Vendedor', 'Cliente', 'Otro'])],
            'birth_date' => 'nullable|date',
            'limit' => 'nullable',
            'vendedor_id' => 'nullable',
            'typeprice_id' => 'nullable',
            'shoppingcontact' => 'nullable|max:100',
            'conditionpayment_id' => 'nullable'
        ];
    }            

    public function render()
    {
        $this->bulkDisabled = count($this->selectedModel) < 1;

        $clients = new Client();

        $clients = $clients->QueryTable($this->keyWord, $this->sortField, $this->sortDirection)->paginate(20);

        return view('basics::livewire.client.view', compact('clients'));        
    }

    public function store()
    {   
        can('client create');

        $validate = $this->validate();    	
        
        Client::create($validate);        
        
        $this->resetInput();        
    	$this->emit('alert', ['type' => 'success', 'message' => 'Tercero creado']);
        
    }

    public function edit()
    {   
        can('client update'); 

        $record = Client::findOrFail($this->selected_id);
            
        $this->identification = $record->identification;
        $this->first_name = $record->first_name;
        $this->last_name = $record->last_name;
        $this->client_name = $record->client_name;        
        $this->type_document = $record->type_document;
        $this->address = $record->address;
        $this->phone = $record->phone;
        $this->cel_phone = $record->cel_phone;
        $this->entry_date = $record->entry_date;
        $this->email = $record->email;
        $this->gender = $record->gender;
        $this->type = $record->type;
        $this->birth_date = $record->birth_date;
        $this->limit = $record->limit;
        $this->vendedor_id = $record->vendedor_id;
        $this->typeprice_id = $record->typeprice_id;
        $this->shoppingcontact = $record->shoppingcontact;
        $this->conditionpayment_id = $record->conditionpayment_id;

        $this->show = true;
    }

    public function update()
    {
        can('client update'); 

        $validate = $this->validate();

        if ($this->selected_id) {
    		$record = Client::find($this->selected_id);
            $record->update($validate);

            $this->resetInput();            
    		$this->emit('alert', ['type' => 'success', 'message' => 'Tercero actualizado']);
        }
    }

    public function toggleClient()
    {
        can('client toggle');

        if (count($this->selectedModel)) {
            //consultamos todos los status y consultamos los modelos de los usuarios seleccionado
            $status = Client::whereIn('id', $this->selectedModel)->get('status')->toArray();
            $record = Client::whereIn('id', $this->selectedModel);            
            
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
            $this->emit('alert', ['type' => 'warning', 'message' => 'Selecciona un Tercero']);
        }
    }  
   
}
