<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\User;
use Illuminate\Validation\Rule;

class TaskForm extends Form
{
    public $title = '';
 
    public $description = '';

    public $admin;
    public $user = null;


    public function rules()
    {
        return [
            'title' => ['required', 'max:255'],
            'description' => 'nullable|max:1024',
            'admin' => ['required', Rule::exists(User::class, 'id')->where(fn($query) => $query->where('is_admin', true))],
            'user' => ['required', Rule::exists(User::class, 'id')->where(fn($query) => $query->where('is_admin', false))],
        ];
    }
}
