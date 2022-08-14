<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;


    public function taskLeaderKey(): Attribute{
        $employees=Employee::whereHas('roles',function($query){
            $query->where('name','=','Employee');
        })->get();
        $data='';
        foreach($employees as $employee){
            if($this->employee_id ==$employee->id){
                $data=$employee->name;
            }
        }
        return new Attribute(get: fn()=> $data );
    }

    public function projectNameKey(): Attribute{
        $projects=Project::all();
        $data='';
        foreach($projects as $project){
            if($this->project_id ==$project->id){
                $data=$project->name;
            }
        }
        return new Attribute(get: fn()=> $data );
    }

    public function statusKey(): Attribute{
        $data='';
        if($this->status =='toDo'){
            $data='To Do';
        }elseif($this->status =='inprogress'){
            $data='Inprogress';
        }
        elseif($this->status =='completed'){
            $data='Completed';
        }
        
        
        return new Attribute(get: fn()=> $data );
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
