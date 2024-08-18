<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\TaskStatus;
use App\Enums\TaskPriority;
use Illuminate\Database\Eloquent\Model;
use Asantibanez\LaravelEloquentStateMachines\Traits\HasStateMachines;
use App\StateMachines\StatusStateMachine;

class Task extends Model
{
    use HasFactory, HasStateMachines;


    protected $guarded = [];

    protected $casts = [
        'status' => TaskStatus::class,
    ];
    protected $cast = [
        'priority' => TaskPriority::class,
    ];

    public $stateMachines = [
        'status' => StatusStateMachine::class
    ];
}
