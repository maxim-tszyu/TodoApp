<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Task;
class DashboardController extends Controller
{
    public function index() {
        $tasks_created = Task::all()->where('user_id', auth()->user()->id)->count();
        $tasks_finished =  Task::all()->where('user_id', auth()->user()->id)->where('status','finished')->count();
        $tasks_abandoned = Task::all()->where('user_id', auth()->user()->id)->where('status','abandoned')->count();
        $stat_created_table = [];
        $stat_finished_table = [];
        $all_tasks = Task::all()->where('user_id', auth()->user()->id)->map(function ($task) use (&$stat_created_table, &$stat_finished_table) {
            $day_of_week_created = $task->created_at->dayOfWeek;
            $day_of_week_finished = Carbon::parse($task->date_finished)->dayOfWeek;
            if (isset($stat_table[$day_of_week_created])) {
                $stat_created_table[$day_of_week_created]++;
            } else {
                $stat_created_table[$day_of_week_created] = 1;
            }
            if (isset($stat_finished_table[$day_of_week_finished])) {
                $stat_finished_table[$day_of_week_finished]++;
            } else {
                $stat_finished_table[$day_of_week_finished] = 1;
            }
        });
        $most_created = array_search(max($stat_created_table), $stat_created_table);
        $most_finished =  array_search(max($stat_finished_table), $stat_finished_table);
        $days = [
            0 => 'Воскресенье',
            1 => 'Понедельник',
            2 => 'Вторник',
            3 => 'Среду',
            4 => 'Четверг',
            5 => 'Пятницу',
            6 => 'Субботу',
        ];
        $day_most_created = $days[$most_created];
        $day_most_finished = $days[$most_finished];
        return view('dashboard', compact('tasks_created', 'tasks_finished', 'tasks_abandoned', 'day_most_created', 'day_most_finished'));
    }
}
