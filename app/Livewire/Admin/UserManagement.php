<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class UserManagement extends Component
{
    public $users;

    public function mount(): void
    {
        $this->users = User::all();
    }

    public function deleteUser(int $userId): void
    {
        User::find($userId)->delete();
        $this->users = User::all();
    }

    public function render()
    {
        return view('livewire.admin.user-management');
    }
}
