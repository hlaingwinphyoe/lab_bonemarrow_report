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
        $aspirates = Aspirate::when(isset(request()->aspirateSearch),function ($query){
            $aspirateSearch = request()->aspirateSearch;
            $query->where('patient_name','LIKE',"%$aspirateSearch%")->orwhere('sc_date','LIKE',"%$aspirateSearch%");
        })->latest('id')->paginate(5,['*'],'aspiratePage');
        $trephines = Trephine::when(isset(request()->trephineSearch),function ($query){
            $trephineSearch = request()->trephineSearch;
            $query->where('patient_name','LIKE',"%$trephineSearch%")->orwhere('sc_date','LIKE',"%$trephineSearch%");
        })->latest('id')->paginate(5,['*'],'trephinePage');
        $histos = Histo::when(isset(request()->histoSearch),function ($query){
            $histoSearch = request()->histoSearch;
            $query->where('name','LIKE',"%$histoSearch%")->orwhere('bio_receive_date','LIKE',"%$histoSearch%")->orwhere('bio_cut_date','LIKE',"%$histoSearch%")->orwhere('bio_report_date','LIKE',"%$histoSearch%");
        })->latest('id')->paginate(5,['*'],'histoPage');
        $cytos = Cyto::when(isset(request()->cytoSearch),function ($query){
            $cytoSearch = request()->cytoSearch;
            $query->where('name','LIKE',"%$cytoSearch%")->orwhere('bio_receive_date','LIKE',"%$cytoSearch%")->orwhere('bio_cut_date','LIKE',"%$cytoSearch%")->orwhere('bio_report_date','LIKE',"%$cytoSearch%");
        })->latest('id')->paginate(5,['*'],'cytoPage');

        return view('index',['aspirates'=>$aspirates,'trephines'=>$trephines,'histos'=>$histos,'cytos'=>$cytos]);
    }

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

}
