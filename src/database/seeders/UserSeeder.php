<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    private const ADMIN_COUNT = 100;
    private const USER_COUNT = 10000;
    private const BATCH_SIZE = 1000;
    public function run()
    {
        $this->truncateUsers();
        $this->seedAdmins();
        $this->seedUsers();
    }

    private function seedAdmins()
    {
        $adminData = User::factory()->admin()->count(self::ADMIN_COUNT)->make();
        foreach ($adminData->chunk(self::BATCH_SIZE) as $batch) {
            DB::table('users')
                ->insert(
                    $batch->map(fn ($admin) => $admin->toBulkSeedingArray())
                        ->toArray()
                );
        }
    }

    private function seedUsers()
    {
        $userData = User::factory()->count(self::USER_COUNT)->make();
        foreach ($userData->chunk(self::BATCH_SIZE) as $batch) {
            DB::table('users')
                ->insert(
                    $batch->map(fn ($user) => $user->toBulkSeedingArray())
                        ->toArray()
                );
        }
    }

    private function truncateUsers()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
