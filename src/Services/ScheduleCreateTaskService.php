<?PHP

namespace ConfrariaWeb\ScheduleCreateTask\Services;

use Auth;
use ConfrariaWeb\Task\Jobs\CreateTaskJob;

class ScheduleCreateTaskService
{

    function execute($schedule, $obj)
    {
        $task = $schedule->options['task'];
        if ($task['user_id'] == 'this') {
            $task['user_id'] = (Auth::check()) ? Auth::id() : $schedule->user_id;
        }
        $task['sync']['destinateds'] = array_map(
            function ($user) use ($schedule, $obj) {
                if ($user == 'this') {
                    return (Auth::check()) ? Auth::id() : $schedule->user_id;
                }
                if ($user == 'self') {
                    return $obj->id;
                }
                return $user;
            },
            $task['sync']['destinateds']
        );

        $task['sync']['responsibles'] = array_map(
            function ($user) use ($schedule, $obj) {
                if ($user == 'this') {
                    return (Auth::check()) ? Auth::id() : $schedule->user_id;
                }
                if ($user == 'self') {
                    return $obj->id;
                }
                return $user;
            },
            $task['sync']['responsibles']
        );
        CreateTaskJob::dispatch($task);
    }

}
