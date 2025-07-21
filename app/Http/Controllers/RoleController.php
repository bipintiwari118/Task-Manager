<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function create(){
        return view('admin.role.create');
    }

    public function store(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required|unique:roles,name',
        ]);

        if ($validator->fails()) {
            return redirect()->route('role.create')
                        ->withErrors($validator)
                        ->withInput();
        }

        Role::create([
            'name'=>$request->name
        ]);

         return redirect()->route('role.list')->with('success','Role added successfully.');
    }


    public function list(){
        $roles=Role::all();
          return view('admin.role.list',compact('roles'));
    }

    public function edit($id){
        $role=Role::findOrFail($id);
         return view('admin.role.edit',compact('role'));
    }

    public function update(Request $request,$id){
        $validator=Validator::make($request->all(),[
            'name'=>'required|unique:roles,name'.$id->id,
        ]);

        if ($validator->fails()) {
            return redirect()->route('role.edit')
                        ->withErrors($validator)
                        ->withInput();
        }
         $role=Role::findOrFail($id);

         $role->update([
            'name'=>$request->name,
         ]);
           return redirect()->route('role.list')->with('success','Role Updated successfully.');
    }


    public function delete($id){
         $role=Role::findOrFail($id);
         $role->delete();
         return redirect()->route('role.list')->with('success','Role deleted successfully.');
    }



    public function addPermission($id){
        $role=Role::findOrFail($id);
        $permissions=Permission::all();
        $rolePermissions=DB::table('role_has_permissions')
                                ->where('role_has_permissions.role_id',$role->id)
                                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                                ->all();
        return view('admin.role.addPermission',compact('role','permissions','rolePermissions'));
    }


    public function giveRolePermission(Request $request,$id){
          $role=Role::findOrFail($id);
          $role->syncPermissions($request->permission);

         return redirect()->route('role.list')->with('success','Permission added successfully.');
    }

}
