<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendances=Attendance::with('employee')->get();
        // $employees=Employee::all();
        return response()->view('TaskManagement.attendance.index',['attendances'=>$attendances]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $date=date('Y-m-d');
        $employees=Employee::all();
        return response()->view('TaskManagement.attendance.create',['employees'=>$employees,'date'=>$date]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator=validator($request->all(),[
            'employee_id'=>'required|numeric|exists:employees,id',
            'date'=>'required',
            'presence'=>'required|boolean',
            'late'=>'required|boolean',
            'absence'=>'required|boolean',
        ]);

        if(!$validator->fails()){
            $attendance=new Attendance();
            $attendance->employee_id=$request->input('employee_id');
            $attendance->date=$request->input('date');
            $attendance->presence=$request->input('presence');
            $attendance->late=$request->input('late');
            $attendance->absence=$request->input('absence');

            $isSaved=$attendance->save();

         
            return response()->json([
                'message'=>$isSaved ? 'Saved successfully' : 'Save failed']
                ,$isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);

        }else{
            return response()->json([
                'message'=>$validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
