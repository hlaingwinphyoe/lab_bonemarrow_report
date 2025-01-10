<?php

namespace App\Http\Controllers;

use App\Models\Aspirate;
use App\Models\Cyto;
use App\Models\Histo;
use App\Models\SpecimenType;
use App\Models\Trephine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PageController extends Controller
{

    public function users(){
        $users = User::query()->whereHas("roles", function($q){ $q->whereNotIn("name", ["admin"]); })->get();
        $roles = Role::all();
        $permissions = Permission::all();
        return view('user.users',compact('users','roles','permissions'));
    }


    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|integer|exists:roles,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $user->assignRole($request->role);

//        $user->permissions()->attach($request->permissions);
        return redirect()->back()->with('status',"Successfully Created!");
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('user.edit',compact('user','roles','permissions'));
    }

    public function update(Request $request, User $user)
    {
        $user->removeRole($user->roles()->detach());

        $user->assignRole($request->role);
//        $user->permissions()->detach();
//
//        $user->permissions()->attach($request->permissions);

        return redirect()->route('users')->with('status',"Successfully Updated!");
    }

    public function destroy($id){
        $currentUser = User::findOrFail($id);
        $currentName = $currentUser->name;
//        $currentUser->permissions()->detach();
        $currentUser->delete();
        return redirect()->back()->with('success',$currentName." User has been deleted.");

    }

    // 404 Page
    public function denied(){
        return view('denied');
    }

    public function totalSales(){
        $aspirates = Aspirate::all();
        $trephines = Trephine::all();
        $histos = Histo::all();
        $cytos = Cyto::all();

        $specimens = SpecimenType::withCount(['aspirates','trephines','histos','cytos'])->get();

        return view('sales',['aspirates'=>$aspirates,'trephines'=>$trephines,'histos'=>$histos,'cytos'=>$cytos,'specimens'=>$specimens]);
    }

}
