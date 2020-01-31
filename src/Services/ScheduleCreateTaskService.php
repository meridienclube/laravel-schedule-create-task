<?PHP
namespace ConfrariaWeb\ScheduleCreateTask\Services;

use Auth;
use ConfrariaWeb\Task\Jobs\CreateTaskJob;

class ScheduleCreateTaskService
{
    function execute($schedule, $obj)
    {
        $userThisId = (Auth::check()) ? Auth::id() : $schedule->user_id;
        $task = $schedule->options['task'];
        $task['user_id'] = $task['user_id'] ?? $userThisId;
        if(isset($task['sync']['destinateds'])) {
            $task['sync']['destinateds'] = array_map(function ($user) use ($userThisId) {
                return $user ?? $userThisId;
            }, $task['sync']['destinateds']);
        }
        if(isset($task['sync']['responsibles'])) {
            $task['sync']['responsibles'] = array_map(function ($user) use ($userThisId) {
                return $user ?? $userThisId;
            }, $task['sync']['responsibles']);
        }
        if("App\User" == get_class($obj) && (!isset($task['sync']['responsibles']) || !isset($task['sync']['destinateds']))){
            $task['sync']['responsibles'] = $task['sync']['responsibles']?? [$userThisId];
            $task['sync']['destinateds'] = $task['sync']['destinateds']?? [$obj->id];
        }
        CreateTaskJob::dispatch($task);
    }
}
