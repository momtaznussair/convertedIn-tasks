<?php

use App\Livewire\Tasks\CreateTask;
use App\Livewire\Tasks\Tasks;
use App\Livewire\Tasks\TasksStatistics;
use Illuminate\Support\Facades\Route;


Route::redirect('/', '/tasks');

Route::prefix('tasks')
->name('tasks.')
->group(function () {
    Route::get('/', Tasks::class)->name('list');
    Route::get('/create', CreateTask::class)->name('create');
    Route::get('/statistics', TasksStatistics::class)->name('statistics');
});

