<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //

    public function showLogin(Request $request){
            return response()->view('TaskManagement.auth.login');
     }



     public function login(Request $request){
        
        $validator=validator($request->all(),[
            
            'email'=>'required|email|exists:employees,email',
            'password'=>'required|string',
            'remember'=>'required|boolean',
        ]);

        
        if(!$validator->fails()){
            if(Auth::guard('employee')->attempt($request->only(['email','password']) , $request->input('remember'))){
                return response()->json([
                    'message'=>' logged in successfully'
                ],Response::HTTP_OK);
            }else{
              return response()->json([
                'message'=>'The password is incorrect, try login again'
              ],Response::HTTP_BAD_REQUEST);  
            }

        }else{
            return response()->json([
                'message'=>$validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        };
     }


     public function logout(Request $request){
       
        Auth::guard('employee')->logout();
        $request->session()->invalidate();
        return redirect()->route('login');
    
        
    }

    public function editPassword(){
        return response()->view('TaskManagement.auth.editPassword');
    }

  

    public function updatePassword(Request $request){
        
        $validator=validator($request->all(),[
            'current_password'=>'required|string|current_password:employee',
            'new_password'=>'required|string|confirmed',
        ]);

        if(!$validator->fails()){

            $user=$request->user('employee');
            $user->password=Hash::make($request->input('new_password'));
            $isSaved=$user->save();
            
            return response()->json([
                'message'=>'Updated Password successfully'
            ],Response::HTTP_OK);  
        }else{
            return response()->json([
                'message'=>$validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        };
    }
}
