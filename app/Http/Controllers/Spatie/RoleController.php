<?php

namespace App\Http\Controllers\Spatie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::all();
        $permissions = Permission::all();
        return view('role.index',compact('roles','permissions'));
    }

    public function create(){
        $permissions = Permission::all();
        return view('role.create',compact('permissions'));
    }

    public function store(Request $request){
        $request->validate(['name'=>['required','min:3']]);
        $role  = new Role();
        $role->name = $request->name;
        $role->save();

        $role->permissions()->attach($request->permissions);

        return redirect()->route('roles.index')->with('status',"Role Created!");
    }


    public function show(){
        //
    }

    public function edit(Role $role){
        $permissions = Permission::all();
        return view('role.edit',compact('role','permissions'));
    }

    public function update(Request $request, Role $role){
        $request->validate(['name'=>['required','min:3']]);
        $role->name = $request->name;
        $role->update();

        $role->permissions()->detach();

        $role->permissions()->attach($request->permissions);
        return redirect()->route('roles.index')->with('status',"Roles Updated!");
    }

    public function destroy(Role $role){
        // delete all permissions related with role
        $role->permissions()->detach();

        $role->delete();
        return back()->with('success',"Role deleted successful.");
    }

}
