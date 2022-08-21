<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->authorizeResource(Role::class,'role');
    }


    public function index()
    {
        //
        $roles=Role::withCount('permissions')->paginate(10);
        return response()->view('TaskManagement.role.index',['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('TaskManagement.role.create');

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
            'name'=>'required|string|max:100',
            'guard_name'=>'required|string|in:employee',
            

        ]);

        if(!$validator->fails()){
            $role=new Role();
            $role->name=$request->input('name');
            $role->guard_name=$request->input('guard_name');
            $isSaved=$role->save();

            return response()->json([
                'message'=>$isSaved ? 'Created successfully' : 'Create failed']
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
     * @param  \App\Models\role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(role $role)
    {
        return response()->view('TaskManagement.role.edit',['role'=>$role]);
     
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, role $role)
    {
        //
        $validator=validator($request->all(),[
            'name'=>'required|string|max:100',
            'guard_name'=>'required|string|in:employee',
        ]);

        if(!$validator->fails()){
            
            $role->name=$request->input('name');
            $role->guard_name=$request->input('guard_name');
            $isSaved=$role->save();

            return response()->json([
                'message'=>$isSaved ? 'Created successfully' : 'Create failed']
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
     * @param  \App\Models\role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(role $role)
    {
        //
        $isDeleted=$role->delete();
        return response()->json([
            'title'=>$isDeleted ?'Deleted successfuliy' :'Deleted failed',
            'message'=>$isDeleted ?'Role Deleted successfuliy' :'Role Deleted failed',
            'icon'=>$isDeleted ?'success' :'error'
           ],$isDeleted ? Response::HTTP_OK :Response::HTTP_BAD_REQUEST);
    }


    public function editRolePermission(Request $request, Role $role)
    {
        $permissions=Permission::where('guard_name','=',$role->guard_name)->get();
        $rolePermissions=$role->permissions;
        if(count($rolePermissions)>0){
            foreach($permissions as  $permission){
                $permission->setAttribute('assigned',false);
                foreach($rolePermissions as $rolePermission){
                    if($permission->id == $rolePermission->id){
                        $permission->setAttribute('assigned',true);
                    }
                }
            }
        }
        return response()->view('TaskManagement.role.rolePermission',['permissions'=>$permissions,'roles'=>$role]);
    }



    public function updateRolePermission(Request $request, Role $role)
    {
        $validator=validator($request->all(),[
            'permission_id'=>'required|numeric|exists:permissions,id',
            ]);

            if(!$validator->fails()){
                $permission=Permission::findById($request->input('permission_id'),'employee');
                $role->hasPermissionTo($permission) 
                ? $role->revokePermissionTo($permission)
                : $role->givePermissionTo($permission);
                
    
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
