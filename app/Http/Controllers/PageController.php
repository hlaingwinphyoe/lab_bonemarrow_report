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

class PageController extends Controller
{

    public function users(){
        $users = User::where('role','1')->get();
        return view('users',compact('users'));
    }


    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect()->back()->with('status',"Successfully Created!");
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function destroy($id){
        $currentUser = User::findOrFail($id);
        $currentName = $currentUser->name;
        $currentUser->delete();
        return redirect()->back()->with('success',$currentName." User has been deleted.");

    }

    public function makeAdmin(Request $request){
        $currentUser = User::findOrFail($request->id);
        if ($currentUser->role == 1){
            $currentUser->role = '0';
            $currentUser->update();
        }
        return redirect()->back()->with('success',$currentUser->name." has been changed to Admin");
    }

    // 404 Page
    public function denied(){
        return view('denied');
    }

    // total sales
    public function totalSales(){
        // for one month data
//        $aspirates = Aspirate::whereMonth('created_at', Carbon::now()->month)->get();
//        $trephines = Trephine::whereMonth('created_at', Carbon::now()->month)->get();
//        $histos = Histo::whereMonth('created_at', Carbon::now()->month)->get();
//        $cytos = Cyto::whereMonth('created_at', Carbon::now()->month)->get();

        $aspirates = Aspirate::all();
        $trephines = Trephine::all();
        $histos = Histo::all();
        $cytos = Cyto::all();

//        $currentDate = date('d-m-Y');
//        $first = Carbon::createFromFormat('d-m-Y', $currentDate)
//                        ->firstOfMonth()
//                        ->format('d-m-Y');

        $specimens = SpecimenType::withCount(['aspirates','trephines','histos','cytos'])->get();

        return view('sales',['aspirates'=>$aspirates,'trephines'=>$trephines,'histos'=>$histos,'cytos'=>$cytos,'specimens'=>$specimens]);
    }

}
