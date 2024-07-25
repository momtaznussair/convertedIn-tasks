<?php

namespace App\Livewire\Tasks;

use App\Services\TaskStatisticsService;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Tasks Statistics')]
class TasksStatistics extends Component
{
    public $users;

    public function mount(TaskStatisticsService $taskStatisticsService)
    {
        $this->users = $taskStatisticsService->getTopUsersByTaskCount();
    }

    public function render()
    {
        return view('livewire.tasks.tasks-statistics');
    }
}
