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

    // public function sale(){
    //     $aspirates = Aspirate::all();
    //     $trephines = Trephine::all();
    //     $histos = Histo::all();
    //     $cytos = Cyto::all();

    //     $specimens = SpecimenType::withCount(['aspirates','trephines','histos','cytos'])->get();

    //     return view('sales',['aspirates'=>$aspirates,'trephines'=>$trephines,'histos'=>$histos,'cytos'=>$cytos,'specimens'=>$specimens]);
    // }

    public function totalSales()
    {

        $start = request('start') ? Carbon::parse(request('start')) : now()->startOfMonth();

        $end = request('end') ? Carbon::parse(request('end')) : now();

        // specimen
        $specimens = SpecimenType::withCount([
            'aspirates' => function ($q) use ($start, $end) {
                $q->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end);
            },
            'trephines' => function ($q) use ($start, $end) {
                $q->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end);
            },
            'histos' => function ($q) use ($start, $end) {
                $q->where('is_complete','0')->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end);
            },
            'cytos' => function ($q) use ($start, $end) {
                $q->where('is_complete','0')->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end);
            }
        ])->get();

        $aspirateCount = $specimens->sum('aspirates_count');

        $aspirateTotal = $specimens->sum(function ($aspirate) {
            return $aspirate->price * $aspirate->aspirates_count;
        });

        $trephineCount = $specimens->sum('trephines_count');

        $trephineTotal = $specimens->sum(function ($trephine) {
            return $trephine->price * $trephine->trephines_count;
        });

        $histoCount = $specimens->sum('histos_count');

        $histoTotal = $specimens->sum(function ($histo) {
            return $histo->price * $histo->histos_count;
        });

        $cytoCount = $specimens->sum('cytos_count');

        $cytoTotal = $specimens->sum(function ($cyto) {
            return $cyto->price * $cyto->cytos_count;
        });


        return view('sales')->with([
            'start' => $start,
            'end' => $end,

            'aspirateTotal' => $aspirateTotal,
            'aspirateCount' => $aspirateCount,

            'trephineTotal' => $trephineTotal,
            'trephineCount' => $trephineCount,

            'histoTotal' => $histoTotal,
            'histoCount' => $histoCount,

            'cytoTotal' => $cytoTotal,
            'cytoCount' => $cytoCount,

            'specimens' => $specimens
        ]);
    }

}
