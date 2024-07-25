<?php

use App\Jobs\UpdateTaskStatisticsCache;
use Illuminate\Support\Facades\Schedule;



Schedule::job(new UpdateTaskStatisticsCache)->daily();


