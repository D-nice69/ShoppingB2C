<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::latest()->paginate(5);
        return view('admin.role.index',compact('roles'));
    }
    public function create()
    {
        $permission_parents = Permission::where('parent_id',0)->get();       
        return view('admin.role.create',compact('permission_parents'));
    }
    public function store(Request $request)
    {
        $role = Role::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);
        $role->permissions()->attach($request->permission_id);
        return redirect()->route('role.index');
    }
    public function edit($id)
    {
        $role = Role::find($id);
        $permission_parents = Permission::where('parent_id',0)->get();
        $permission_role = $role->permissions;
        return view('admin.role.edit',compact('role','permission_parents','permission_role'));
    }
    public function update($id,Request $request)
    {
        $role = Role::find($id);
        $role->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);
        $role->permissions()->sync($request->permission_id);
        return redirect()->route('role.index');
    }
    public function delete($id) 
    {
        Role::find($id)->delete();
        return response()->json([
            'code' => 200,
            'message' => 'success',
        ],200);
        return response()->json([
            'code' => 500,
            'message' => 'fail',
        ],500);
    }
}
