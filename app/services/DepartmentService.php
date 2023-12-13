<?php
namespace App\Services;

use App\Repositories\DepartmentRepository;

class DepartmentService
{
    protected $departmentRepository;


    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function store($data){
        return $this->departmentRepository->store($data);
    }

    public function update($data, $department){
        return $this->departmentRepository->update($data, $department);
    }

    public function destroy($department){
        return $this->departmentRepository->destroy($department);
    }
}
?>
