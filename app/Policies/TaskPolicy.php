<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function updateIsFinished(User $employee, Task $task)
    {
        return $employee && $employee->id === $task->employee_id;
    }
}
