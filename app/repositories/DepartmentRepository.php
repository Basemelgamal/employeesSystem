<?php
namespace App\Repositories;

use App\Models\Department;

class DepartmentRepository
{

    public function store($data){
        return Department::create($data);
    }

    public function update($data, $department){
        return $department->update($data);
    }

    public function destroy($department){
        return Department::destroy($department);
    }
}
?>
