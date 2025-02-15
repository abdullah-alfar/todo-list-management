<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Task;

class TaskManagement extends Component
{
    public $tasks;

    public function mount(): void
    {
        $this->tasks = Task::all();
    }

    public function deleteTask(int $taskId): void
    {
        Task::find($taskId)->delete();
        $this->tasks = Task::all();
    }

    public function render()
    {
        return view('livewire.admin.task-management');
    }
}
