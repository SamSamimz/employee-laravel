<?php

namespace App\Livewire;

use App\Models\Country;
use App\Models\State;
use Livewire\Component;

class StateIndex extends Component
{
    public $name;
    public $country_id;
    public $search = '';
    public $filterState = null;
    public $stateId = null;

    protected $rules = [
        'name' => 'required|min:3',
        'country_id' => 'required',
    ];
    
    public function editState(State $state) {
        $this->openModal();
        $this->stateId = $state->id;
        $this->name = $state->name;
        $this->country_id = $state->country_id;
    }

    public function deleteState(State $state) {
        $state->delete();
        $this->reset();
    }
    
    public function addState() {
        $this->validate();
        if($this->stateId) {
            State::find($this->stateId)->update(['name' => $this->name,'country_id' => $this->country_id]);
        }else {
            State::create(['name' => $this->name,'country_id' => $this->country_id]);
        }
        $this->reset();
        $this->closeModal();
    }
    
    public function openModal() {
        if(!$this->stateId) {
            $this->reset();
        }
        $this->dispatch('openModal');
    }

    public function closeModal() {
        $this->reset();
        $this->dispatch('closeModal');
    }
    public function render()
    {
        $countries = Country::all();
        if(strlen($this->search) > 1) {
            if($this->filterState) {
                $states = State::where('name','LIKE','%'.$this->search.'%')
                ->where('country_id',$this->filterState)
                ->paginate(5);
            }
            $states = State::where('name','LIKE','%'.$this->search.'%')->paginate(5);
        }elseif($this->filterState) {
            $states = State::where('country_id',$this->filterState.'%')->paginate(5);
        }else {
            $states = State::paginate(5);
        }
        return view('livewire.state-index',compact('states','countries'));
    }
}
