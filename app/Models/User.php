<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

   /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Accessors
    public function getNameAttribute(){
        return $this->first_name.' '.$this->last_name;
    }

    public function getSalaryAttribute(){
        return count($this->managers) > 0 ? ($this->managers->first())->pivot->salary : 0;
    }

    public function getImageAttribute(){
        if(count($this->managers) > 0){
            if(($this->managers->first())->pivot->image){
                $image = url('storage/employees/'.($this->managers->first())->pivot->image);
            }else{
                $image = null;
            }
        }else{
            $image = null;
        }
        return $image;
    }

    public function getDepartmentNameAttribute(){
        if(count($this->departments()->get()) > 0){
            return $this->departments->first()->name ?? null;
        }else{
            return null;
        }
    }

    public function getDepartmentAttribute(){
        if(count($this->departments()->get()) > 0){
            return $this->departments()->first() ?? null;
        }else{
            return null;
        }
    }

    public function getManagerNameAttribute(){
        if(count($this->managers) > 0){
            return $this->managers->first()->name ?? null;
        }else{
            return null;
        }
    }

    public function getManagerAttribute(){
        if(count($this->managers) > 0){
            return $this->managers->first() ?? null;
        }else{
            return  null;
        }
    }


    // Scopes
    public function scopeName($query, $request)
    {
        return $query->when(isset($request['search']), function ($query) use ($request) {
            return$query->where('first_name', 'LIKE', '%'.$request['search'].'%')->orWhere('Last_name', 'LIKE', '%'.$request['search'].'%');
        });
    }

    public function scopeAllManagers($query)
    {
        return $query->whereHas('roles', function ($query) {
            $query->where('name', 'manager');
        });
    }

    public function scopeAllEmployees($query)
    {
        return $query->whereHas('roles', function ($query) {
            $query->where('name', 'employee');
        });
    }

    // Relations
    public function managers()
    {
        return $this->belongsToMany(User::class, 'employee_manager_department', 'employee_id', 'manager_id')
            ->withPivot(['manager_id', 'department_id', 'salary', 'image']);
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'employee_manager_department', 'employee_id', 'department_id')
            ->withPivot('department_id');
    }

    public function tasks(){
        return $this->hasMany(Task::class, 'employee_id');
    }
}
