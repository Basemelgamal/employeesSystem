<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\User;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    protected $taskService;
    public function __construct(TaskService $taskService) {
        $this->taskService = $taskService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $employee)
    {
        $data = [
            'employee'      => $employee,
            'tasks'         => $employee->tasks,
            'routeCreate'   => route('tasks.create', $employee->id),
        ];

        return view('manager.tasks.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $employee)
    {
        $data = [
            'employee' => $employee,
        ];

        return view('manager.tasks.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request, User $employee)
    {
        DB::beginTransaction();
        try {
            $mergedData = array_merge($request->validated(), ['employee_id' => $employee->id]);
            $this->taskService->store($mergedData);
            DB::commit();
            return redirect()->route('tasks.index', $employee->id)->with(['success' => 'Added Successfully']);
        }catch(\Throwable $th){
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Failed']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task, User $employee)
    {
        $this->authorize('updateIsFinished', $task);

        $request->validate([
            'is_finished' => 'required|boolean',
        ]);

        $task->update([
            'is_finished' => $request->input('is_finished'),
        ]);

        return redirect()->route('tasks.index', $mployee)->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
