<?php

namespace App\Http\Controllers;

use App\Models\Aspirate;
use App\Models\Cyto;
use App\Models\Histo;
use App\Models\Trephine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PageController extends Controller
{
    public function index(){
        $aspirates = Aspirate::when(isset(request()->search),function ($query){
            $search = request()->search;
            $query->where('patient_name','LIKE',"%$search%")->orwhere('sc_date','LIKE',"%$search%");
        })->latest('id')->paginate(5);
        $trephines = Trephine::when(isset(request()->search),function ($query){
            $search = request()->search;
            $query->where('patient_name','LIKE',"%$search%")->orwhere('sc_date','LIKE',"%$search%");
        })->latest('id')->paginate(5);
        $histos = Histo::when(isset(request()->search),function ($query){
            $search = request()->search;
            $query->where('name','LIKE',"%$search%")->orwhere('bio_receive_date','LIKE',"%$search%")->orwhere('bio_cut_date','LIKE',"%$search%")->orwhere('bio_report_date','LIKE',"%$search%");
        })->latest('id')->paginate(5);
        $cytos = Cyto::when(isset(request()->search),function ($query){
            $search = request()->search;
            $query->where('name','LIKE',"%$search%")->orwhere('bio_receive_date','LIKE',"%$search%")->orwhere('bio_cut_date','LIKE',"%$search%")->orwhere('bio_report_date','LIKE',"%$search%");
        })->latest('id')->paginate(5);

        return view('index',['aspirates'=>$aspirates,'trephines'=>$trephines,'histos'=>$histos,'cytos'=>$cytos]);
    }

    public function users(){
        $users = User::where('role','1')->get();
        return view('users',compact('users'));
    }

    public function registration()
    {
        return view('auth.register');
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

        return redirect()->back()->with('status',"User Created Successful.");
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
        return redirect()->back()->with('success',"<b>".$currentName."</b> User has been deleted.");

    }

    public function makeAdmin(Request $request){
        $currentUser = User::findOrFail($request->id);
        if ($currentUser->role == 1){
            $currentUser->role = '0';
            $currentUser->update();
        }
        return redirect()->back()->with('success',"<b>".$currentUser->name."</b>"." has been changed to Admin");
    }

}
