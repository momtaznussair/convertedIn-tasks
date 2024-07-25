<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Tasks List')]
class Tasks extends Component
{
    use WithPagination;

    public function render()
    {
        $tasks = Task::with('assignor:id,name', 'assignee:id,name')
        ->simplePaginate(3);

        return view('livewire.tasks.tasks', [
            'tasks' => $tasks,
        ]);
    }
}
