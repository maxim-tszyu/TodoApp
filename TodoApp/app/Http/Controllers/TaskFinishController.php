<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskFinishController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Task $task)
    {
        if($task->status == 'in process'){
            $task->status = 'finished';
            $task->date_finished =  date('Y-m-d H:i:s');
            $task->save();
        }
        return redirect()->back();
    }
}
