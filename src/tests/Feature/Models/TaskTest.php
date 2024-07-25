<?php

namespace Tests\Feature\Models;

use Tests\TestCase;
use App\Models\Task;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a task has an assigned user.
     *
     * @return void
     */
    #[Test]
    public function it_has_an_assigned_to_user()
    {
        // Arrange
        $assignee = User::factory()->create(['is_admin' => false]);
        $assignor = User::factory()->create(['is_admin' => true]);

        $task = Task::factory()->create([
            'assigned_to_id' => $assignee->id,
            'assigned_by_id' => $assignor->id,
        ]);

        // Act & Assert
        $this->assertInstanceOf(User::class, $task->assignee);
        $this->assertEquals($assignee->id, $task->assignee->id);
    }


    /**
     * Test that a task has an assignor user.
     *
     * @return void
     */
    #[Test]
    public function it_has_an_assigned_by_user()
    {
        // Arrange
        $assignee = User::factory()->create(['is_admin' => false]);
        $assignor = User::factory()->create(['is_admin' => true]);

        $task = Task::factory()->create([
            'assigned_to_id' => $assignee->id,
            'assigned_by_id' => $assignor->id,
        ]);

        // Act & Assert
        $this->assertInstanceOf(User::class, $task->assignor);
        $this->assertEquals($assignor->id, $task->assignor->id);
    }
}
