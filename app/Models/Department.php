<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    public function getTotalSalariesAttribute()
    {
        $total = 0;
        if(count($this->employees) > 0)
        {
            foreach($this->employees as $employee){
                $total += $employee->salary;
            }
        }

        return $total;
    }

    public function employees()
    {
        return $this->belongsToMany(User::class, 'employee_manager_department', 'department_id', 'employee_id')
            ->withPivot('manager_id', 'salary', 'image')
            ->withTimestamps();
    }
}
