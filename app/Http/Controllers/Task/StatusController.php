<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStatusRequest;
use App\Models\Task;
use Asantibanez\LaravelEloquentStateMachines\Exceptions\TransitionNotAllowedException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StatusController extends Controller
{
    public function update(TaskStatusRequest $request, $id)
    {
        try {
            $task = Task::findOrFail($id);
            $taskData = $request->validated();
            $status = $taskData['status'];
            $task->status()->transitionTo($to = $status);
        } catch (TransitionNotAllowedException $exception) {
            return response()->json(['status' => 'Transition not allowed']);
        }

        return response()->json($task);
    }
}
