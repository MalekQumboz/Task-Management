<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    public function statusKey(): Attribute{
        $status='';
        if($this->status == 'late'){
            $status='Late';
        }elseif($this->status == 'presence'){
            $status='Presence';
        }elseif($this->status == 'absence'){
            $status='Absence';
        }
        

        return new Attribute(get: fn()=> $status );
    }    

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
