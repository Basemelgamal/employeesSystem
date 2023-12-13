<?php
namespace App\Services;

use App\Repositories\EmployeeManagerRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\TaskRepository;
use App\Traits\FileAttributes;
use Illuminate\Support\Facades\Hash;

class TaskService
{
    protected $taskRepository;


    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function store($data){
        return $this->taskRepository->store($data);
    }

    public function update($data, $task){
        return $this->taskRepository->update($data, $task);
    }
}
?>
