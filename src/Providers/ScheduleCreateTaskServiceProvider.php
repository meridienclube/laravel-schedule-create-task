<?php
namespace ConfrariaWeb\ScheduleCreateTask\Providers;

use ConfrariaWeb\ScheduleCreateTask\Services\ScheduleCreateTaskService;
use Illuminate\Support\ServiceProvider;

class ScheduleCreateTaskServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../Views', 'schedule_create_task');
    }

    public function register()
    {
        $this->app->bind('ScheduleCreateTaskService', function ($app) {
            return new ScheduleCreateTaskService();
        });
    }

}
