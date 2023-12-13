<?php
namespace App\Services;

use App\Repositories\EmployeeManagerRepository;
use App\Repositories\EmployeeRepository;
use App\Traits\FileAttributes;
use Illuminate\Support\Facades\Hash;

class EmployeeService
{
    use FileAttributes;
    protected $employeeRepository, $employeeManagerRepository, $imageFolder = 'employees';


    public function __construct(EmployeeRepository $employeeRepository, EmployeeManagerRepository $employeeManagerRepository)
    {
        $this->employeeRepository =  $employeeRepository;
        $this->employeeManagerRepository = $employeeManagerRepository;
    }

    public function employees($request = null){
        return $this->employeeRepository->employees($request);
    }

    public function managers(){
        return $this->employeeRepository->managers();
    }

    public function store($array){

        $data = [
            'first_name'    => $array['first_name'],
            'last_name'     => $array['last_name'],
            'email'         => $array['email'],
            'phone'         => $array['phone'],
            'password'      => Hash::make($array['password']),
        ];

        if(!is_null($array['image'])){
            $image = $this->setImageAttribute($array['image']);
        }

        $managerData = [
            'salary'        => $array['salary']         ?? null,
            'manager_id'    => $array['manager_id']     ?? null,
            'image'         => $image                   ?? null,
            'department_id' => $array['department_id']  ?? null,
        ];

        $employee = $this->employeeRepository->store($data);
        return $this->employeeManagerRepository->store($employee, $managerData);
    }

    public function update($array, $id){
        $employee = $this->employeeRepository->employee($id);
        if(is_null($array['password'])){
            $userPassword = $employee->password;
            $array['password'] = bcrypt($userPassword);
        }

        $data = [
            'first_name'    => $array['first_name'],
            'last_name'     => $array['last_name'],
            'email'         => $array['email'],
            'phone'         => $array['phone'],
            'password'      => !is_null($array['password']) ? Hash::make($array['password']) : $employee->password,
        ];

        if(!is_null($array['image'])){
            $image = $this->setImageAttribute($array['image']);
        }

        $managerData = [
            'salary'        => $array['salary'] ?? $employee->salary,
            'manager_id'    => $array['manager_id'] ?? $employee->manager_id,
            'image'         => $image ?? $employee->image,
            'department_id' => $array['department_id'] ?? $employee->department_id,
        ];

        $this->employeeRepository->update($data, $employee);
        return $this->employeeManagerRepository->update($managerData, $employee);
    }

    public function destroy($department){
        return $this->employeeRepository->destroy($department);
    }
}
?>
