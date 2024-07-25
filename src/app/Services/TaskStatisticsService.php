<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class TaskStatisticsService
{
    private const CACHE_KEY = 'top_users_task_count';

    private const CACHE_DURATION= 1440; // Cache duration in minutes 60 * 24 (24 hours);
    private const USER_COUNT = 10;

    /**
     * Get the top users with task counts, using cache if available.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getTopUsersByTaskCount()
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_DURATION, function () {
            return self::updateCache();
        });
    }

    /**
     * Update the cache with the latest top users' task counts.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function updateCache()
    {
        $topUsers = User::has('tasks')
            ->withCount('tasks')
            ->orderBy('tasks_count', 'desc')
            ->take(self::USER_COUNT)
            ->get(self::USER_COUNT);

        Cache::put(self::CACHE_KEY, $topUsers, self::CACHE_DURATION);

        return $topUsers;
    }
}
