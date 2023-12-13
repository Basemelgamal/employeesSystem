<?php
namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{

    public function store($data){
        return Task::create($data);
    }

    public function update($data, $task){
        return $task->update($data, $task);
    }
}
?>
