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

    public function __construct()
    {
        $this->authorizeResource(Attendance::class,'attendance');
    }

    public function index()
    {
        $attendances=Attendance::with('employee')->paginate(10);
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
        $attendances=Attendance::where('date','=',$date)->get();
        return response()->view('TaskManagement.attendance.create',
        ['employees'=>$employees,'date'=>$date,'attendances'=>$attendances]);
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
            // 'date'=>'required',
            'status'=>'required|string',
            
        ]);

        if(!$validator->fails()){
            $attendance=new Attendance();
            $attendance->employee_id=$request->input('employee_id');
            $date=date('Y-m-d');
            $attendance->date=$date;
            $attendance->status=$request->input('status');
            

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
        $validator=validator($request->all(),[
            'status'=>'required|string|exists:attendances,status',
            ]);

            if(!$validator->fails()){
                $attendance->status=$request->input('status');
                $isSaved=$attendance->save();

                return response()->json([
                    'message'=>'Updated successfully ']
                    , Response::HTTP_OK );
    
            }else{
                return response()->json([
                    'message'=>$validator->getMessageBag()->first()
                ],Response::HTTP_BAD_REQUEST);
            };
     
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
        $isDeleted= $attendance->delete(); 

       return response()->json([
        'title'=>$isDeleted ?'Deleted successfuliy' :'Deleted failed',
        'message'=>$isDeleted ?'Attendance Deleted successfuliy' :'Attendance Deleted failed',
        'icon'=>$isDeleted ?'success' :'error'
       ],$isDeleted ? Response::HTTP_OK :Response::HTTP_BAD_REQUEST);
    }
}
