<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    //Display listing of tasks

    public function index(Request $request)
    {
        // $tasks = Task::all();
        $tasks = Task::where('user_id', '=', $request->user()->id);

        // using traditional filtering to get the list

        /* $status = $request->query('status');
        if (isset($status)) {
            $tasks = $tasks->where('status', '=', $status);
        }
        $label = $request->query('label');
        if (isset($label)) {
            $tasks = $tasks->where('label', '=', $label);
        }*/

        $sortPriority = $request->query('sortPriority');
        if (isset($sortPriority)) {
            if ($sortPriority == 'desc')
                $tasks = $tasks->orderByRaw("FIELD(priority, \"high\", \"medium\", \"low\")");
            else
                $tasks = $tasks->orderByRaw("FIELD(priority, \"low\", \"medium\", \"high\")");
        }

        $sortDeadline = $request->query('sortDeadline');
        if (isset($sortDeadline)) {

            $tasks = $tasks->orderBy('deadline', $sortDeadline);
        }

        $tasks = $tasks->get();

        return response()->json($tasks);
    }

    public function store(TaskRequest $request)
    {
        // Validation is automatically handled by TaskRequest

        $data = array_merge($request->validated(), ['user_id' => $request->user()->id]);
        $task = Task::create($data);

        return response()->json($task);
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);

        // Validation is automatically handled by TaskRequest
        $task->update($request->validated());
        return response()->json(['message' => 'Task updated successfully', 'task' => $task]);
    }
}
