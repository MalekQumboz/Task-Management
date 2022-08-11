<?php

namespace App\Models;

// use Attribute;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function departmentName(): Attribute{
        $department='';
        if($this->department == 'HR'){
            $department='Human Resource';
        }elseif($this->department == 'PM'){
            $department='Project Manager';
        }elseif($this->department == 'E'){
            $department='Employee';
        }
        

        return new Attribute(get: fn()=> $department );
    }    

    public function projects()
    {
        return $this->belongsToMany(Project::class, Employee_Project::class, 'employee_id', 'project_id');
    }

    public function employeeProjects()
    {
        return $this->hasMany(Employee_Project::class, 'employee_id', 'id');
    }

    public function attendances()
    {
        return $this->hasMany(Attribute::class, 'employee_id', 'id');
    }
    public function tasks()
    {
        return $this->hasMany(Task::class, 'employee_id', 'id');
    }
   
}
