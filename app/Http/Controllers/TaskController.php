<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::where('user_id', '=', $request->user()->id);
        $tasks = Task::filter()->sort()->get();

        return response()->json($tasks);
    }

    public function store(TaskRequest $request)
    {
        $data = array_merge($request->validated(), ['user_id' => $request->user()->id]);
        $task = Task::create($data);

        return response()->json($task);
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->validated());

        return response()->json(['message' => 'Task updated successfully', 'task' => $task]);
    }
}
