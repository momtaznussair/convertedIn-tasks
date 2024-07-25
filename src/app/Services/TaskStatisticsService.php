<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class TaskStatisticsService
{
    protected $cacheKey = 'top_users_task_count';

    private const USER_COUNT = 10;
    protected $cacheDuration = 1440; // Cache duration in minutes 60 * 24 (24 hours)

    /**
     * Get the top users with task counts, using cache if available.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTopUsersByTaskCount()
    {
        return Cache::remember($this->cacheKey, $this->cacheDuration, function () {
            return $this->updateCache();
        });
    }

    /**
     * Update the cache with the latest top users' task counts.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function updateCache()
    {
        $topUsers = User::has('tasks')
            ->withCount('tasks')
            ->orderBy('tasks_count', 'desc')
            ->take(self::USER_COUNT)
            ->get();

        Cache::put($this->cacheKey, $topUsers, $this->cacheDuration);

        return $topUsers;
    }
}
