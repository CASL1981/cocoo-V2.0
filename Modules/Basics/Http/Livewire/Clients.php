<?php

namespace Modules\Basics\Http\Livewire;

use App\Traits\TableLivewire;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Basics\Entities\Client;
use Modules\Basics\Entities\Employee;
use Modules\Basics\Entities\Payment;
use Modules\Basics\Entities\TypePrice;
use App\Traits\CRUDLivewireTrait;
use Modules\Basics\Http\Requests\RequestClient;

class Clients extends Component
{
    use WithPagination;
    use TableLivewire;
    use CRUDLivewireTrait;

    public $identification, $first_name, $last_name, $client_name, $status, $type_document, $address, $phone; 
    public $cel_phone, $entry_date, $email, $gender, $type, $birth_date, $limit, $vendedor_id, $typeprice_id;
    public $shoppingcontact, $conditionpayment_id;
    public $vendedores, $payments, $typeprices;

    protected $listeners = ['toggleClient', 'showaudit'];
    
    public function hydrate()
    {
        $this->vendedores = Employee::where('vendedor', true)->where('status', true)
                        ->pluck('first_name', 'identification')->toArray();

        $this->payments = Payment::pluck('name', 'id')->toArray();

        $this->typeprices = TypePrice::where('status', 'Open')->pluck('name', 'id')->toArray(); 
        
        $this->permissionModel = 'client';
        
        $this->messageModel = 'Terceros';
                        
        $this->model = 'Modules\Basics\Entities\Client';
        $this->exportable ='App\Exports\ClientsExport';
    }          

    public function render()
    {
        $clients = new Client();

        $clients = $clients->QueryTable($this->keyWord, $this->sortField, $this->sortDirection)->paginate(20);

        return view('basics::livewire.client.view', compact('clients'));        
    }

    public function store()
    {   
        can('client create');

        $requestClient = new RequestClient();        

        $validate = $this->validate($requestClient->rules());     	
        
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

        if ($this->selected_id) {
            //Consultamos el tercero seleccionado
    		$record = Client::find($this->selected_id);

            $requestClient = new RequestClient();        
            //validamos el request
            $validate = $this->validate($requestClient->rules($record)); 
            //actualizamos el registro seleccionado
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
