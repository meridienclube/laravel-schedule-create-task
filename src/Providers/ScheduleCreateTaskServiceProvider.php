<?php
namespace ConfrariaWeb\ScheduleCreateTask\Providers;

use ConfrariaWeb\ScheduleCreateTask\Services\ScheduleCreateTaskService;
use Illuminate\Support\ServiceProvider;

class ScheduleCreateTaskServiceProvider extends ServiceProvider
{

    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind('ScheduleCreateTaskService', function ($app) {
            return new ScheduleCreateTaskService();
        });
    }

}
