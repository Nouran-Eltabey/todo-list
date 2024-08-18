<?php

namespace App\StateMachines;

use Asantibanez\LaravelEloquentStateMachines\StateMachines\StateMachine;

class StatusStateMachine extends StateMachine
{
    public function recordHistory(): bool
    {
        return true;
    }

    public function transitions(): array
    {
        return [
            'todo' => ['inprogress', 'closed'],
            'inprogress' => ['done', 'closed'],
        ];
    }

    public function defaultState(): ?string
    {
        return 'todo';
    }
}
