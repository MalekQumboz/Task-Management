<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // public function progressKey(): Attribute{
    //     $projects=Project::withCount('tasks')->get();
    //     $taskCompleted=Project::withCount(['tasks'=>function($query){
    //         $query->where('status','=','completed');
    //     }])->get();
    //     $progress=0.0;
    //     if($projects->tasks_count >0){
    //         $progress=($taskCompleted->tasks_count/$projects->tasks_count)*100;
    //     }
        
    //     return new Attribute(get: fn()=> $progress );
    // }

    

    public function statusKey(): Attribute{
        $data='';
        if($this->status =='completed'){
            $data='Completed';
        }elseif($this->status =='inprogress'){
            $data='Inprogress';
        }
        elseif($this->status =='canceled'){
            $data='Canceled';
        }
        
        return new Attribute(get: fn()=> $data );
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, Employee_Project::class,'project_id', 'employee_id');
    }

    public function projectEmployees()
    {
        return $this->hasMany(Employee_Project::class, 'project_id', 'id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id', 'id');
    }
}
