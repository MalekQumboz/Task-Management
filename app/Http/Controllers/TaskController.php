<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Project;
use App\Models\task;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class taskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employees=Employee::whereHas('roles',function($query){
            $query->where('name','=','Employee');
        })->get();
        $projects=Project::all();
        $tasks=task::paginate(10);
        return response()->view('TaskManagement.task.index',
        ['tasks'=>$tasks,'employees'=>$employees,'projects'=>$projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $employees=Employee::whereHas('roles',function($query){
            $query->where('name','=','Employee');
        })->get();
        $projects=Project::all();
        return response()->view('taskManagement.task.create',
        ['employees'=>$employees,'projects'=>$projects]);
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
            'name'=>'required|string|min:3|max:100',
            'description'=>'required|string|min:3',
            'status'=>'required|string',
            'project_id'=>'required|numeric|exists:projects,id',
            'employee_id'=>'required|numeric|exists:employees,id',
        ]);

        if(!$validator->fails()){
            $task=new task();
            $task->name=$request->input('name');
            $task->description=$request->input('description');
            $task->status=$request->input('status');
            $task->project_id=$request->input('project_id');
            $task->employee_id=$request->input('employee_id');

            $isSaved=$task->save();

         
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
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(task $task)
    {
        //
        $employees=Employee::whereHas('roles',function($query){
            $query->where('name','=','Employee');
        })->get();
        $projects=Project::all();
        return response()->view('taskManagement.task.edit',
        ['employees'=>$employees,'projects'=>$projects,'tasks'=>$task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, task $task)
    {
        //
        $validator=validator($request->all(),[
            'name'=>'required|string|min:3|max:100',
            'description'=>'required|string|min:3',
            'status'=>'required|string',
            'project_id'=>'required|numeric|exists:projects,id',
            'employee_id'=>'required|numeric|exists:employees,id',
        ]);

        if(!$validator->fails()){
           
            $task->name=$request->input('name');
            $task->description=$request->input('description');
            $task->status=$request->input('status');
            $task->project_id=$request->input('project_id');
            $task->employee_id=$request->input('employee_id');

            $isSaved=$task->save();

         
            return response()->json([
                'message'=>$isSaved ? 'Saved successfully' : 'Save failed']
                ,$isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);

        }else{
            return response()->json([
                'message'=>$validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(task $task)
    {
        //
    }

    
    public function updateStatus(Request $request, task $task)
    {
        $validator=validator($request->all(),[
            'status'=>'required|string|exists:tasks,status',
            ]);

            if(!$validator->fails()){
                $task->status=$request->input('status');
                $isSaved=$task->save();

                return response()->json([
                    'message'=>'Updated successfully ']
                    , Response::HTTP_OK );
    
            }else{
                return response()->json([
                    'message'=>$validator->getMessageBag()->first()
                ],Response::HTTP_BAD_REQUEST);
            };
    }
}
