<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the admin scope only returns admin users.
     *
     * @return void
     */
    public function testAdminScope()
    {
        // Arrange: Create admin and non-admin users
        $admin = User::factory()->create(['is_admin' => true]);
        $nonAdmin = User::factory()->create(['is_admin' => false]);

        // Act: Retrieve users using the admin scope
        $admins = User::admin()->get();

        // Assert: Only the admin user should be returned
        $this->assertCount(1, $admins);
        $this->assertTrue($admins->contains($admin));
        $this->assertFalse($admins->contains($nonAdmin));
    }

    /**
     * Test that the user scope only returns non-admin users.
     *
     * @return void
     */
    public function testUserScope()
    {
        // Arrange: Create admin and non-admin users
        $admin = User::factory()->create(['is_admin' => true]);
        $nonAdmin = User::factory()->create(['is_admin' => false]);

        // Act: Retrieve users using the user scope
        $users = User::user()->get();

        // Assert: Only the non-admin user should be returned
        $this->assertCount(1, $users);
        $this->assertTrue($users->contains($nonAdmin));
        $this->assertFalse($users->contains($admin));
    }
}
