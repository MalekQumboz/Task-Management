<?php

namespace App\Http\Controllers;

use App\Mail\PasswordEmail;
use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Nette\Utils\Random;
use Spatie\Permission\Models\Role;
use Str;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employee=employee::with('roles')->get();
        return response()->view('TaskManagement.employee.index',
        ['employees'=>$employee]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $departmentRole=Role::where('guard_name','=','employee')->get();
        return response()->view('TaskManagement.employee.create',
        ['departmentRole'=>$departmentRole]);

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
            'gender'=>'required|String',
            'birthday'=>'required|date',
            'email'=>'required|email|unique:employees,email',
            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'department_id'=>'required|numeric|exists:roles,id',
            'salary'=>'required|numeric',
            'hiring'=>'required|date',
            // 'password'=>['required','String',Password::min(6)->letters()->numbers()->uncompromised()],
        ]);

        if(!$validator->fails()){
            $employee=new Employee();
            $employee->name=$request->input('name');
            $employee->gender=$request->input('gender');
            $employee->birthday=$request->input('birthday');
            $employee->email=$request->input('email');
            $employee->phone=$request->input('phone');
            $employee->salary=$request->input('salary');
            $employee->hiring=$request->input('hiring');
            $password=Str::random(8);
            $employee->password=Hash::make($password);            

            $isSaved=$employee->save();

            if($isSaved){
                Mail::to($employee->email)->send(new PasswordEmail($employee,$password));
                $employee->syncRoles(Role::findById($request->input('department_id'),'employee'));

            }
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
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(employee $employee)
    {
        //
        $departmentRole=Role::where('guard_name','=','employee')->get();
        $CurrentRole=$employee->roles[0];
        return response()->view('TaskManagement.employee.edit',
        ['employees'=>$employee,'departmentRole'=>$departmentRole ,'CurrentRole'=>$CurrentRole]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, employee $employee)
    {
        //
        $validator=validator($request->all(),[
            'name'=>'required|string|min:3|max:100',
            'gender'=>'required|String',
            'birthday'=>'required|date',
            'email'=>'required|email|unique:employees,email,'.$employee->id,
            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'department_id'=>'required|numeric|exists:roles,id',
            'salary'=>'required|numeric',
            'hiring'=>'required|date',
            // 'password'=>['required','String',Password::min(6)->letters()->numbers()->uncompromised()],
        ]);

        if(!$validator->fails()){
            $employee->name=$request->input('name');
            $employee->gender=$request->input('gender');
            $employee->birthday=$request->input('birthday');
            $employee->email=$request->input('email');
            $employee->phone=$request->input('phone');
            $employee->salary=$request->input('salary');
            $employee->hiring=$request->input('hiring');
            // $password=Str::random(8);
            // $employee->password=Hash::make($password);            

            $isSaved=$employee->save();

            if($isSaved){
                // Mail::to($employee->email)->send(new PasswordEmail($employee,$password));
                $employee->syncRoles(Role::findById($request->input('department_id'),'employee'));

            }
         
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(employee $employee)
    {
        //
        $isDeleted= $employee->delete(); 

       return response()->json([
        'title'=>$isDeleted ?'Deleted successfuliy' :'Deleted failed',
        'message'=>$isDeleted ?'Employee Deleted successfuliy' :'Employee Deleted failed',
        'icon'=>$isDeleted ?'success' :'error'
       ],$isDeleted ? Response::HTTP_OK :Response::HTTP_BAD_REQUEST);
    }
}
