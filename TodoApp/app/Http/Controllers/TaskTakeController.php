<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskTakeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Task $task)
    {
        if($task->status == 'not taken'){
            $task->status = 'in process';
            $task->save();
        }
        return redirect()->back();
    }
}
