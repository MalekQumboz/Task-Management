<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $projects=Project::withCount('tasks')->paginate(10);

        $tasksCompleted=Project::withCount(['tasks'=>function($query){
            $query->where('status','=','completed');
        }])->get();

        $projectManagers=Employee::whereHas('roles',function($query){
            $query->where('name','=','Project Manager');
        })->get();

        return response()->view('TaskManagement.project.index',
        ['projects'=>$projects,'projectManagers'=>$projectManagers,'tasksCompleted'=>$tasksCompleted]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        $projectManagers=Employee::whereHas('roles',function($query){
            $query->where('name','=','Project Manager');
        })->get();

        return response()->view('TaskManagement.project.create',['projectManagers'=>$projectManagers]);
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
            'projectManager'=>'required|string|exists:employees,name',
        ]);

        if(!$validator->fails()){
            $project=new Project();
            $project->name=$request->input('name');
            $project->description=$request->input('description');
            $project->status=$request->input('status');
            $project->projectManager=$request->input('projectManager');

            $isSaved=$project->save();

         
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
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
        $projectManagers=Employee::whereHas('roles',function($query){
            $query->where('name','=','Project Manager');
        })->get();
        return response()->view('TaskManagement.project.edit',['projectManagers'=>$projectManagers,'projects'=>$project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
        $validator=validator($request->all(),[
            'name'=>'required|string|min:3|max:100',
            'description'=>'required|string|min:3',
            'status'=>'required|string',
            'projectManager'=>'required|string|exists:employees,name',
        ]);

        if(!$validator->fails()){
            $project->name=$request->input('name');
            $project->description=$request->input('description');
            $project->status=$request->input('status');
            $project->projectManager=$request->input('projectManager');

            $isSaved=$project->save();

         
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
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
        $isDeleted= $project->delete(); 

        return response()->json([
         'title'=>$isDeleted ?'Deleted successfuliy' :'Deleted failed',
         'message'=>$isDeleted ?'Employee Deleted successfuliy' :'Employee Deleted failed',
         'icon'=>$isDeleted ?'success' :'error'
        ],$isDeleted ? Response::HTTP_OK :Response::HTTP_BAD_REQUEST);
    }


public function showTasks( Project $project)
    {
        $tasks=Task::where('project_id','=',$project->id)->paginate(10);
     
        return response()->view('TaskManagement.project.projectTasks',['tasks'=>$tasks,'projects'=>$project]);
    }

}