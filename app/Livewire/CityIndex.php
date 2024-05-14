<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\State;
use Livewire\Component;

class CityIndex extends Component
{
    public $name;
    public $state_id;
    public $search = '';
    public $filterCity = null;
    public $cityId = null;

    protected $rules = [
        'name' => 'required|min:3',
        'state_id' => 'required',
    ];
    
    public function editCity(City $city) {
        $this->openModal();
        $this->cityId = $city->id;
        $this->name = $city->name;
        $this->state_id = $city->state_id;
    }

    public function deleteCity(City $city) {
        $city->delete();
        $this->reset();
    }
    
    public function addCity() {
        $this->validate();
        if($this->cityId) {
            City::find($this->cityId)->update(['name' => $this->name,'state_id' => $this->state_id]);
        }else {
            City::create(['name' => $this->name,'state_id' => $this->state_id]);
        }
        $this->reset();
        $this->closeModal();
    }
    
    public function openModal() {
        if(!$this->cityId) {
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
        $states = State::all();
        $cities = City::paginate(5);
        if(strlen($this->search) > 1) {
            if($this->filterCity) {
                $cities = City::where('name','LIKE','%'.$this->search.'%')
                ->where('state_id',$this->filterCity)
                ->paginate(5);
            }
            $cities = City::where('name','LIKE','%'.$this->search.'%')->paginate(5);
        }elseif($this->filterCity) {
            $cities = City::where('state_id',$this->filterCity.'%')->paginate(5);
        }else {
            $cities = City::paginate(5);
        }
        return view('livewire.city-index',compact('states', 'cities'));
    }
}
