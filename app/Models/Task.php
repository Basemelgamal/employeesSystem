<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'title',
        'subject'
    ];

    public function employee(){
        return $this->hasOne(User::class, 'employee_id');
    }
}
