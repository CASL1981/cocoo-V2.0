<?php

namespace App\Http\Livewire;

use App\Models\Profile;
use Livewire\Component;

class Profiles extends Component
{
    public $userId, $firstname, $lastname, $email;
    public $identification, $position, $profession, $bio, $address, $phone, $facebook, $twitter, $instagram;

    public $show = false; //varible que controla el modal

    public function mount()
    {
        $user = auth()->user();

        $this->firstname = $user->firstname;
        $this->lastname = $user->lastname;
        $this->email = $user->email;
        $this->userId = $user->id;
        
        $perfil = Profile::where('user_id',$this->userId)->first();
        $this->identification = $perfil->identification;
        $this->position = $perfil->position;
        $this->profession = $perfil->profession;
        $this->bio = $perfil->bio;
        $this->address = $perfil->address;
        $this->phone = $perfil->phone;
        $this->facebook = $perfil->facebook;
        $this->twitter = $perfil->twitter;
        $this->instagram = $perfil->instagram;

    }

    protected function rules() 
    {
        return [
            'identification' => 'nullable|min:6|max:11',
            'position' => 'nullable|min:3|max:100',
            'profession' => 'nullable|min:3|max:100',
            'bio' => 'nullable|min:10|max:300',
            'address' => 'nullable|min:6|max:192',
            'phone' => 'nullable|min:6|max:20',
            'facebook' => 'nullable|min:3|max:40',
            'twitter' => 'nullable|min:3|max:40',
            'instagram' => 'nullable|min:3|max:40'
        ];
    }    

    public function render()
    {
        return view('livewire.profile.view');
    }

    public function cancel()
    {
        $this->show = false;
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
        $this->reset();
    }

    public function edit()
    {        
        $record = Profile::where('user_id',$this->userId)->get();
        
    	$this->identification = $record->identification;
    	$this->position = $record->position;
    	$this->profession = $record->profession;
    	$this->bio = $record->bio;
    	$this->address = $record->address;
    	$this->phone = $record->phone;
    	$this->facebook = $record->facebook;
    	$this->twitter = $record->twitter;
    	$this->instagram = $record->instagram;

        $this->show = true;
    }

    public function update()
    {
        $validate = $this->validate();

        if ($this->userId) {
    		$record = Profile::where('user_id',$this->userId)->first();
    		// $record = Profile::findOrFail($this->userId);
            // dd($record);
    		// $record = Profile::find($record);
            $record->update($validate);
            
    		$this->emit('alert', ['type' => 'success', 'message' => 'Perfil actualizado']);
        }
    }
}
