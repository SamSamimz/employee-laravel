<?php

namespace App\Livewire;

use App\Models\Country;
use Livewire\Component;

class CountryIndex extends Component
{
    public $name;
    public $country_code;
    public $search = '';
    public $countryId = null;

    protected $rules = [
        'name' => 'required|min:3',
        'country_code' => 'required|min:3',
    ];
    
    public function editCountry(Country $country) {
        $this->openModal();
        $this->countryId = $country->id;
        $this->name = $country->name;
        $this->country_code = $country->country_code;
    }

    public function deleteCountry(Country $country) {
        $country->delete();
        $this->reset();
    }
    
    public function addCountry() {
        $this->validate();
        if($this->countryId) {
            Country::find($this->countryId)->update(['name' => $this->name,'country_code' => $this->country_code]);
        }else {
            Country::create(['name' => $this->name, 'country_code' => $this->country_code]);
        }
        $this->reset();
        $this->closeModal();
    }
    
    public function openModal() {
        if(!$this->countryId) {
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
        if(strlen($this->search) > 1) {
            $countries = Country::where('name','LIKE','%'.$this->search.'%')
            ->orWhere('country_code','LIKE','%'.$this->search.'%')
            ->paginate(5);
        }else {
            $countries = Country::paginate(5);
        }
        return view('livewire.country-index',compact('countries'));
    }
}
