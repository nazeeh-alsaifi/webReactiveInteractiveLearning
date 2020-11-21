<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return compact('permissions',$permissions,'roles',$roles);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rolesPermissions()
    {
        $Roles_Permissions = [];
        $permissions =Permission::all();        
        $roles =Role::all();
        $counter = 0;
        foreach($roles as $role)
        {
            foreach($permissions as $permission)
            {
               if($role->hasPermissionTo($permission->name))
               {
                $counter++;   
                $array = array('id' =>$counter , 'role_id' =>$role->id , 'permission_id' =>$permission->id);
                //$array = Arr::flatten($array);
                $Roles_Permissions [] = $array;
               }
            }
            
        }
        return $Roles_Permissions;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    $this->validate($request, [
            'permissions'=> 'required',
        ]);
        Permission::create(['name'=>$request->input('permissions')]);
        return true;
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addtorole(Request $request)
    {
        $this->validate($request, [
            'role_id'=> 'required',
            'permission_id'=> 'required',
        ]);
        $role = Role::findById($request->input('role_id'));
        $Permission = Permission::findById($request->input('permission_id'));
        $role->givePermissionTo($Permission);
        return true;
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $permissions =Permission::all();        
        $roles =Role::all();
        $counter = 0;
        foreach($roles as $role)
        {
            foreach($permissions as $permission)
            {
               if($role->hasPermissionTo($permission->name))
               {
                $counter++;
                  if($counter == $id)
                  {
                    $myrole = Role::findByName($role->name);
                    $myrole->revokePermissionTo($permission->name);
                    return true;  
                  }   
               }
            }            
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
