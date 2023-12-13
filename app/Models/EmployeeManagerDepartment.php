<?php

namespace App\Models;

use App\Traits\FileAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employeeManagerDepartment extends Model
{
    use FileAttributes, HasFactory;

    protected $table = 'employee_manager_department';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'department_id',
        'manager_id',
        'employee_id',
        'salary',
        'image',
    ];
}
