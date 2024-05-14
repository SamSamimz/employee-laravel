<?php

namespace App\Livewire;

use App\Models\Department;
use Livewire\Component;

class DepartmentIndex extends Component
{

    public $name;
    public $search = '';
    public $departmentId = null;

    protected $rules = [
        'name' => 'required|min:3',
    ];
    
    public function editDepartment(Department $department) {
        $this->openModal();
        $this->departmentId = $department->id;
        $this->name = $department->name;
    }

    public function deleteDepartment(Department $department) {
        $department->delete();
        $this->reset();
    }
    
    public function addDepartment() {
        $this->validate();
        if($this->departmentId) {
            Department::find($this->departmentId)->update(['name' => $this->name]);
        }else {
            Department::create(['name' => $this->name]);
        }
        $this->reset();
        $this->closeModal();
    }
    
    public function openModal() {
        if(!$this->departmentId) {
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
            $departments = Department::where('name','LIKE','%'.$this->search.'%')->paginate(5);
        }else {
            $departments = Department::paginate(5);
        }
        return view('livewire.department-index',compact('departments'));
    }
}
