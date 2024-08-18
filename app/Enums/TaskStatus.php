<?php

namespace App\Enums;

enum TaskStatus: string
{
    case TODO = 'todo';
    case INPROGRESS = 'inprogress';
    case DONE = 'done';
    case CLOSED = 'closed';
}
