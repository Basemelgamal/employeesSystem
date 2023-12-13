<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Department;
use App\Models\User;
use App\Services\EmployeeService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{

    protected $employeeService;
    public function __construct(EmployeeService $employeeService) {
        $this->employeeService = $employeeService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'employees'     => $this->employeeService->employees(request()->only('search')),
            'routeCreate'   => route('employees.create'),
        ];

        return view('manager.employees.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'managers'      => $this->employeeService->managers(),
            'departments'   => Department::all(),
        ];

        return view('manager.employees.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->employeeService->store($request->validated());
            DB::commit();
            return redirect()->route('employees.index')->with(['success' => 'Added Successfully']);
        }catch(\Throwable $th){
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Failed']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'employee'      => User::find($id),
            'managers'      => User::allManagers()->get(),
            'departments'   => Department::all(),
        ];

        return view('manager.employees.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        $this->employeeService->update($request->validated(), $id);
        return redirect()->route('employees.index')->with(['success' => 'Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $this->employeeService->destroy($id);
            return redirect()->route('employees.index')->with(['success' => 'Deleted Successfully']);
        }catch(Exception $e){
            return response()->json(['error' => 'Failed']);
        }
    }
}
