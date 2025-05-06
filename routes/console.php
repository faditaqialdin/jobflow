<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:gmail-sync')->everyMinute()->withoutOverlapping();
Schedule::command('app:linkedin-recommend')->everyMinute()->withoutOverlapping();
