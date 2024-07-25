<?php

namespace Tests\Feature\Livewire;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTaskTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_renders_the_create_task_component()
    {
        $response = $this->get('/tasks/create');

        $response->assertStatus(200)
            ->assertSeeLivewire('tasks.create-task');
    }

    #[Test]
    public function it_allows_an_admin_to_create_a_task()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $user = User::factory()->create();

        Livewire::actingAs($admin)
            ->test('tasks.create-task')
            ->set('form.title', 'New Task')
            ->set('form.description', 'Task Description')
            ->set('form.admin', $admin->id)
            ->set('form.user', $user->id)
            ->call('save')
            ->assertRedirect('/tasks');

        $this->assertDatabaseHas('tasks', [
            'title' => 'New Task',
            'description' => 'Task Description',
            'assigned_by_id' => $admin->id,
            'assigned_to_id' => $user->id,
        ]);
    }


    #[Test]
    public function it_validates_required_fields()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        Livewire::actingAs($admin)
            ->test('tasks.create-task')
            ->call('save')
            ->assertHasErrors(['form.title' => 'required', 'form.admin' => 'required', 'form.user' => 'required']);
    }

    #[Test]
    public function it_prevents_an_admin_from_being_selected_as_assignee()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        Livewire::actingAs($admin)
            ->test('tasks.create-task')
            ->set('form.title', 'Task Title')
            ->set('form.description', 'Task Description')
            ->set('form.admin', $admin->id) // Assignor must be admin
            ->set('form.user', $admin->id)  // Attempt to set admin as assignee
            ->call('save')
            ->assertHasErrors(['form.user' => 'exists']);
    }

    #[Test]
    public function it_prevents_a_user_from_being_selected_as_assignor()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user) // User should not be allowed to assign tasks
            ->test('tasks.create-task')
            ->set('form.title', 'Task Title')
            ->set('form.description', 'Task Description')
            ->set('form.admin', $user->id) // Attempt to set admin as assignor
            ->set('form.user', $user->id)  // Assignee is a non-admin user
            ->call('save')
            ->assertHasErrors(['form.admin' => 'exists']);
    }
}
