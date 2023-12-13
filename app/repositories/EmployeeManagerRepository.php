<?php
namespace App\Repositories;

use App\Models\employeeManagerDepartment;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class EmployeeManagerRepository
{

    public function store($employee, $data){
        return $employee->managers()->attach($data['manager_id'] ?? null, [
            'department_id' => $data['department_id'] ?? null,
            'salary'        => $data['salary'] ?? null,
            'image'         => $data['image']  ?? null,
        ]);
    }

    public function update($data, $employee){
        $employeeManagerDepartment = employeeManagerDepartment::where('employee_id', $employee->id)->get();
        if(count($employeeManagerDepartment) > 0){
            return EmployeeManagerDepartment::where('employee_id', $employee->id)->update($data);
        }else{
            return $this->store($employee,$data);
        }
    }

    public function destroy($employee){
        return User::destroy($employee);
    }
}
?>
