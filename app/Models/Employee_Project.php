<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee_Project extends Model
{
    use HasFactory;

    
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
