<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    public function create(){
        return view('admin.permission.create');
    }

    public function store(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required|unique:permissions,name',
        ]);

        if ($validator->fails()) {
            return redirect()->route('permission.create')
                        ->withErrors($validator)
                        ->withInput();
        }

        Permission::create([
            'name'=>$request->name
        ]);

         return redirect()->route('permission.list')->with('success','Permission added successfully.');
    }


    public function list(){
        $permissions=Permission::paginate(10);
          return view('admin.permission.list',compact('permissions'));
    }

    public function edit($id){
        $permission=Permission::findOrFail($id);
         return view('admin.permission.edit',compact('permission'));
    }

    public function update(Request $request,$id){
        $validator=Validator::make($request->all(),[
            'name'=>'required|unique:permissions,name,' .$id,
        ]);

        if ($validator->fails()) {
            return redirect()->route('permission.edit')
                        ->withErrors($validator)
                        ->withInput();
        }
         $permission=Permission::findOrFail($id);

         $permission->update([
            'name'=>$request->name,
         ]);
           return redirect()->route('permission.list')->with('success','Permission Updated successfully.');
    }


    public function delete($id){
         $permission=Permission::findOrFail($id);
         $permission->delete();
         return redirect()->route('permission.list')->with('success','Permission deleted successfully.');
    }
}
