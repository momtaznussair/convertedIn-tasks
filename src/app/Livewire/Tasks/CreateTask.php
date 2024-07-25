<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use App\Livewire\Forms\TaskForm;

#[Title('Create Task')]
class CreateTask extends Component
{
    public TaskForm $form;
    public $adminSearch = '';
    public $userSearch = '';
    public $admins = [];
    public $users = [];
    public $selectedAdmin = null;
    public $selectedUser = null;
    public $adminPage = 1;
    public $userPage = 1;

    protected $queryString = [
        'adminPage' => ['except' => 1],
        'userPage' => ['except' => 1],
    ];

    public function mount()
    {
        $this->loadAdmins();
        $this->loadUsers();
    }

    public function updatedAdminSearch()
    {
        $this->adminPage = 1;
        $this->loadAdmins();
    }

    public function updatedUserSearch()
    {
        $this->userPage = 1;
        $this->loadUsers();
    }

    public function loadAdmins()
    {
        $this->admins = User::where('is_admin', true)
            ->where('name', 'like', '%' . $this->adminSearch . '%')
            ->paginate(10, ['*'], 'adminPage', $this->adminPage)
            ->items();
    }

    public function loadUsers()
    {
        $this->users = User::where('is_admin', false)
            ->where('name', 'like', '%' . $this->userSearch . '%')
            ->paginate(10, ['*'], 'userPage', $this->userPage)
            ->items();
    }

    public function loadMoreAdmins()
    {
        $this->adminPage++;
        $this->loadAdmins();
    }

    public function loadMoreUsers()
    {
        $this->userPage++;
        $this->loadUsers();
    }

    public function selectAdmin($adminId, $adminName)
    {
        $this->selectedAdmin = $adminId;
        $this->form->admin = $adminId;
        $this->adminSearch = $adminName;
        $this->admins = [];
    }

    public function selectUser($userId, $userName)
    {
        $this->selectedUser = $userId;
        $this->form->user = $userId;
        $this->userSearch = $userName;
        $this->users = [];
    }

    public function save()
    {
        $this->form->validate();
        Task::create([
            'title' => $this->form->title,
            'description' => $this->form->description,
            'assigned_by_id' => $this->form->admin,
            'assigned_to_id' => $this->form->user,
        ]);

        session()->flash('success', 'Task Created successfully!');

        return redirect()->to('/tasks');
    }

    public function render()
    {
        return view('livewire.tasks.create-task');
    }
}
