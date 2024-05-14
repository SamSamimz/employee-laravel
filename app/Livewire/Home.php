<?php

namespace App\Livewire;

use App\Models\Employee;
use App\Models\User;
use Livewire\Component;

class Home extends Component
{
    public $users;
    public $employees;
    public function mount() {
        $this->users = User::count();
        $this->employees = Employee::count();
    }
    public function render()
    {
        return view('livewire.home');
    }
}
