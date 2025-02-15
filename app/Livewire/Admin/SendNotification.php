<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Events\PrivateNotification;

class SendNotification extends Component
{
    public $users;
    public $selectedUserId;
    public $message;

    public function mount(): void
    {
        $this->users = User::all();
    }

    public function send(): void
    {
        $this->validate([
            'selectedUserId' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        broadcast(new PrivateNotification($this->message, $this->selectedUserId))->toOthers();
        $this->reset(['selectedUserId', 'message']);
        session()->flash('message', 'Notification sent successfully!');
    }

    public function render()
    {
        return view('livewire.admin.send-notification');
    }
}
