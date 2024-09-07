<?php

namespace App\Livewire;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $search = '';
    public $username = '';
    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $address = '';
    public $phone = '';
    public $filterUser = null;
    public $userId = null;
    protected $rules = [
        'username'   => 'required|min:3',
        'first_name' => 'required|string',
        'last_name'  => 'required|string',
        'email'      => ['required','string','email'],
        'address'    => 'required|string',
        'phone'      => 'required',
    ];

    public function editUser(User $user) {
        $this->openModal();
        $this->userId     = $user->id;
        $this->username   = $user->username;
        $this->first_name = $user->first_name;
        $this->last_name  = $user->last_name;
        $this->address    = $user->address;
        $this->email      = $user->email;
        $this->phone      = $user->phone;
    }

    public function deleteUser(User $user) {
        $user->delete();
        $this->alert('success','User deleted successfully');
        $this->reset();
    }

    public function addUser() {
        $this->validate();
        if($this->userId) {
            User::find($this->userId)->update([
                'username'   => $this->username,
                'first_name' => $this->first_name,
                'last_name'  => $this->last_name,
                'email'      => $this->email,
                'address'    => $this->address,
                'phone'      => $this->phone,
            ]);
        }else {
            User::create(
                [
                    'username'   => $this->username,
                    'first_name' => $this->first_name,
                    'last_name'  => $this->last_name,
                    'email'      => $this->email,
                    'address'    => $this->address,
                    'phone'      => $this->phone,
                    'password'   => bcrypt('password'),
                ]
            );
        }
        $this->reset();
        $this->closeModal();
    }

    public function openModal() {
        if(!$this->userId) {
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
            $users = User::where('username','LIKE','%'.$this->search.'%')
            ->orWhere('first_name','LIKE','%'.$this->search.'%')
            ->orWhere('last_name','LIKE','%'.$this->search.'%')
            ->orWhere('address','LIKE','%'.$this->search.'%')
            ->orWhere('email','LIKE','%'.$this->search.'%')
            ->paginate(5);
        }else {
            $users = User::paginate(5);
        }
        return view('livewire.user-index',compact('users'));
    }
}