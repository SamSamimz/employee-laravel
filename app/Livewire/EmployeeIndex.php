<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\Employee;
use App\Models\State;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeIndex extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $search = '';
    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $department_id = '';
    public $country_id = '';
    public $state_id = '';
    public $city_id = '';
    public $address = '';
    public $zip_code = '';
    public $birthdate = '';
    public $hired_date;
    public $phone = '';
    public $employeeId = null;
    public $filterEmployee = null;
    public function mount() {
        $this->hired_date = now();
    }
    protected $rules = [
        'first_name'    => 'required|string',
        'last_name'     => 'required|string',
        'department_id' => 'required',
        'country_id'    => 'required',
        'state_id'      => 'required',
        'city_id'       => 'required',
        'zip_code'      => 'required',
        'birthdate'     => 'required|date',
        'hired_date'    => 'required|date',
        'email'         => ['required','string','email'],
        'phone'         => 'required',
    ];

    public function editEmployee(Employee $employee) {
        $this->openModal();
        $this->employeeId    = $employee->id;
        $this->first_name    = $employee->first_name;
        $this->last_name     = $employee->last_name;
        $this->department_id = $employee->department_id;
        $this->country_id    = $employee->country_id;
        $this->state_id      = $employee->state_id;
        $this->city_id       = $employee->city_id;
        $this->zip_code      = $employee->zip_code;
        $this->birthdate     = $employee->birthdate;
        $this->hired_date    = $employee->hired_date;
        $this->email         = $employee->email;
        $this->phone         = $employee->phone;
    }

    public function deleteEmployee(Employee $employee) {
        $employee->delete();
        $this->alert('success','Employee deleted successfully');
        $this->reset();
    }

    public function addEmployee() {
        $this->validate();
        if($this->employeeId) {
            Employee::find($this->employeeId)->update([
                'first_name'    => $this->first_name,
                'last_name'     => $this->last_name,
                'department_id' => $this->department_id,
                'country_id'    => $this->country_id,
                'state_id'      => $this->state_id,
                'city_id'       => $this->city_id,
                'zip_code'      => $this->zip_code,
                'birthdate'     => $this->birthdate,
                'hired_date'    => $this->hired_date,
                'email'         => $this->email,
                'phone'         => $this->phone,
            ]);
        }else {
            Employee::create(
                [
                'first_name'    => $this->first_name,
                'last_name'     => $this->last_name,
                'department_id' => $this->department_id,
                'country_id'    => $this->country_id,
                'state_id'      => $this->state_id,
                'city_id'       => $this->city_id,
                'zip_code'      => $this->zip_code,
                'birthdate'     => $this->birthdate,
                'hired_date'    => $this->hired_date,
                'email'         => $this->email,
                'phone'         => $this->phone,
                ]
            );
        }
        $this->reset();
        $this->closeModal();
    }

    public function openModal() {
        if(!$this->employeeId) {
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
        $departments = Department::all();
        $countries   = Country::all();
        $states      = State::all();
        $cities      = City::all();

        if(strlen($this->search > 2)) {
            if($this->filterEmployee) {
                $employees = Employee::where('first_name','LIKE','%'.$this->search.'%')
                ->orWhere('last_name','LIKE','%'.$this->search.'%')
                ->orWhere('email','LIKE','%'.$this->search.'%')
                ->orWhere('phone','LIKE','%'.$this->search.'%')
                ->orWhere('zip_code','LIKE','%'.$this->search.'%')
                ->where('department_id',$this->filterEmployee)->paginate(5);
            }
            $employees = Employee::where('first_name','LIKE','%'.$this->search.'%')
            ->orWhere('last_name','LIKE','%'.$this->search.'%')
            ->orWhere('email','LIKE','%'.$this->search.'%')
            ->orWhere('phone','LIKE','%'.$this->search.'%')
            ->orWhere('zip_code','LIKE','%'.$this->search.'%')
            ->paginate(5);
        }elseif($this->filterEmployee) {
            $employees = Employee::where('department_id',$this->filterEmployee)->paginate(5);
        }else {
            $employees = Employee::paginate(5);
        }
        return view('livewire.employee-index',compact('employees','departments', 'countries', 'states', 'cities'));
    }
}