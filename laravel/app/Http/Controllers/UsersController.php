<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\users\Employee;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $you = auth()->user()->id;
        $users = DB::table('users')
        ->select('users.id', 'users.name', 'users.email', 'users.menuroles as roles', 'users.status', 'users.email_verified_at as registered')
        ->whereNull('deleted_at')
        ->get();
        return response()->json( compact('users', 'you') );
    }

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsersRoles()
    {
        $Users_Roles = [];
        $users =User::whereNull('deleted_at')->get();
        $roles =Role::all();
        foreach($roles as $role)
        {
            foreach($users as $user)
            {
               if($user->hasRole($role->name))
               {
                $array = array('user_id' =>$user->id , 'role_id' =>$role->id);
                //$array = Arr::flatten($array);
                $Users_Roles [] = $array;
               }
            }
            
        }
        return $Users_Roles;
    }

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserPermissions()
    {
        $Permissions_Roles = [];
        $you = auth()->user();
        //Permission::create(['name'=>'delete Institution']);
        // $role = Role::findByName('admin');
        // $Permission = Permission::findById(13);
        // $role->givePermissionTo($Permission);
        $permissions =Permission::all();
            foreach($permissions as $permission)
            {
               if($you->can($permission->name))
               {
                $array = array('permission' =>$permission->name);
                $Permissions_Roles [] = $array;
               }
            }
            
        return $Permissions_Roles;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = DB::table('users')
        ->select('users.id', 'users.name', 'users.email', 'users.menuroles as roles', 'users.status', 'users.email_verified_at as registered')
        ->where('users.id', '=', $id)
        ->first();
        return response()->json( $user );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = DB::table('users')
        ->select('users.id', 'users.name', 'users.email', 'users.menuroles as roles', 'users.status')
        ->where('users.id', '=', $id)
        ->first();
        return response()->json( $user );
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
        $validatedData = $request->validate([
            'name'       => 'required|min:1|max:256',
            'email'      => 'required|email|max:256'
        ]);
        $user = User::find($id);
        $user->name       = $request->input('name');
        $user->email      = $request->input('email');
        $user->save();
        //$request->session()->flash('message', 'Successfully updated user');
        return response()->json( ['status' => 'success'] );
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user){
            $user->delete();
        }
        return response()->json( ['status' => 'success'] );
    }
}
