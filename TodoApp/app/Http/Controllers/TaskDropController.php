<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskDropController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Task $task)
    {
        if($task->status == 'in process'){
            $task->status = 'abandoned';
            $task->save();
            return redirect()->back();
        }
    }
}
