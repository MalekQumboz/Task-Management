<?php

namespace App\Models;

// use Attribute;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Employee extends Authenticatable
{
    use HasFactory,HasRoles;
    
    public function StatusKey(): Attribute{
        $data='';
        $date=date('Y-m-d');
        $attendances=Attendance::where('date','=',$date)->get();
        foreach($attendances as $attendance){
            if($this->id ==$attendance->employee_id){
                $data=$attendance->status;
            }
        }
        
        return new Attribute(get: fn()=> $data );
    } 

    public function EmployeeAttendanceID(): Attribute{
        $id=0;
        $date=date('Y-m-d');
        $attendances=Attendance::where('date','=',$date)->get();
        foreach($attendances as $attendance){
            if($this->id ==$attendance->employee_id){
                $id=$this->id;
            }
        }
        
        return new Attribute(get: fn()=> $id );
    }   
    public function attendanceID(): Attribute{
        $id=0;
        $date=date('Y-m-d');
        $attendances=Attendance::where('date','=',$date)->get();
        foreach($attendances as $attendance){
            if($this->id ==$attendance->employee_id){
                $id=$attendance->id;
            }
        }
        return new Attribute(get: fn()=> $id );
    }   

    public function userName():Attribute{
        return new Attribute(get: fn()=> $this->name);
    }

    // public function departmentName(): Attribute{
    //     $department='';
    //     if($this->department == 'HR'){
    //         $department='Human Resource';
    //     }elseif($this->department == 'PM'){
    //         $department='Project Manager';
    //     }elseif($this->department == 'E'){
    //         $department='Employee';
    //     }
        

    //     return new Attribute(get: fn()=> $department );
    // }    

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
