<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class EmployeeRepository
{

    public function employee($id){
        return User::find($id);
    }

    public function employees($request = null){
        return User::name($request)->allEmployees()->get();
    }

    public function managers(){
        return User::allManagers()->get();
    }

    public function store($data){
        $employee = User::create($data);

        // Find or create the role
        $role = Role::findOrCreate('employee');
        $employee->assignRole($role);

        return $employee;
    }

    public function update($data, $employee){
        return $employee->update($data);
    }

    public function destroy($id){
        return User::destroy($id);
    }
}
?>
