<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use App\Services\DepartmentService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\ErrorHandler\Debug;

class DepartmentController extends Controller
{
    protected $departmentService;

    public function __construct(DepartmentService $departmentService) {
        $this->departmentService = $departmentService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'departments'   => Department::all(),
            'routeCreate'   => route('departments.create'),
        ];

        return view('manager.departments.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        DB::beginTransaction();
        try {

            $this->departmentService->store($request->validated());

            DB::commit();
            return redirect()->route('departments.index')->with(['success' => 'Added Successfully']);
        }catch(\Throwable $th){
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Failed']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        $data = [
            'department'  => $department,
        ];

        return view('manager.departments.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $data = [
            'departments'     => $this->departmentService->update($request->validated(), $department),
            'routeCreate'   => route('departments.create'),
        ];

        return redirect()->route('departments.index', $data)->with(['success' => 'Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        try{
            if ($department->employees()->count() > 0) {
                return redirect()->route('departments.index')->with('error', 'Cannot delete department with associated employees.');
            }
            $this->departmentService->destroy($department->id);
            return redirect()->route('employees.index')->with(['success' => 'Deleted Successfully']);
        }catch(Exception $e){
            return response()->json(['error' => 'Failed']);
        }
    }
}
