<?php

namespace App\Http\Controllers;

use App\Models\Aspirate;
use App\Models\Cyto;
use App\Models\Histo;
use App\Models\SpecimenType;
use App\Models\Trephine;
use App\Models\User;
use App\Notifications\CytoApproveResultNotification;
use App\Notifications\HistoApproveResultNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:access approve report'], ['only' => ['toApprove']]);
        $this->middleware(['permission:edit approve report'], ['only' => ['histoApproved','cytoApproved']]);
    }

    public function index(){
        // for one month data
        $aspirates = Aspirate::whereMonth('created_at', Carbon::now()->month)->get()->count();
        $trephines = Trephine::whereMonth('created_at', Carbon::now()->month)->get()->count();
        $histos = Histo::whereMonth('created_at', Carbon::now()->month)->get()->count();
        $cytos = Cyto::whereMonth('created_at', Carbon::now()->month)->get()->count();

        $currentDate = date('d-m-Y');
        $first = Carbon::createFromFormat('d-m-Y', $currentDate)
                        ->firstOfMonth()
                        ->format('d-m-Y');

        $specimens = SpecimenType::withCount(['aspirates','trephines','histos','cytos'])->get();

        $dateArr = [];
        $aspirateRate = [];
        $trephineRate = [];
        $histoRate = [];
        $cytoRate = [];

        $today = date('j M');
        for ($i=9;$i>=0;$i--){
            $date = date_create($today);
            date_sub($date,date_interval_create_from_date_string("$i days"));
            $current = date_format($date,'j M');
            array_push($dateArr,$current);
            $result = Aspirate::whereDate('created_at',Carbon::parse($current)->toDateString())->get()->count();
            array_push($aspirateRate,$result);

            $result2 = Trephine::whereDate('created_at',Carbon::parse($current)->toDateString())->get()->count();
            array_push($trephineRate,$result2);
            $result3 = Histo::whereDate('created_at',Carbon::parse($current)->toDateString())->get()->count();
            array_push($histoRate,$result3);
            $result4 = Cyto::whereDate('created_at',Carbon::parse($current)->toDateString())->get()->count();
            array_push($cytoRate,$result4);

        }

        return view('index',compact('aspirateRate','trephineRate','histoRate','cytoRate','dateArr','aspirates','trephines','histos','cytos','specimens','first','currentDate'));
    }

    public function toapproveHisto(){
        $histos = Histo::with('specimenType')->search()
            ->where('is_complete','0')
            ->where('is_approve','1')
            ->latest('id')
            ->paginate(10);

        $specimens = SpecimenType::all();

        return view('approve.histo',['histos'=>$histos,'specimens'=>$specimens]);
    }

    public function toapproveCyto(){
        $cytos = Cyto::with('specimenType')->search()
            ->where('is_complete','0')
            ->where('is_approve','1')
            ->latest('id')
            ->paginate(10);

        $specimens = SpecimenType::all();
        return view('approve.cyto',['cytos'=>$cytos,'specimens'=>$specimens]);
    }


    public function histoApproved($id)
    {
        $histo = Histo::findOrFail($id);
        if ($histo->is_approve == '1')
        {
            $histo->is_approve = '0';
        }
        $users = User::role(['Admin','User'])->get();
        Notification::send($users,new HistoApproveResultNotification($histo));
        $histo->update();

        return response()->json([
            'status' => 'success',
            'create' => $histo->name.' report အား Authorized Person မှ အတည်ပြုပြီးဖြစ်ပါသည်။',
            'info' => $histo
        ]);
    }

    public function cytoApproved($id)
    {
        $cyto = Cyto::findOrFail($id);
        if ($cyto->is_approve == '1')
        {
            $cyto->is_approve = '0';
        }

        $users = User::role(['Admin','User'])->get();
        Notification::send($users,new CytoApproveResultNotification($cyto));
        $cyto->update();

        return response()->json([
            'status' => 'success',
            'create' => $cyto->name.' report အား Authorized Person မှ အတည်ပြုပြီးဖြစ်ပါသည်။',
            'info' => $cyto
        ]);
    }

    public function histo(){
        $histos = Histo::with('specimenType')->search()
            ->where('is_approve','0')
            ->latest('id')
            ->paginate(10);
        $specimens = SpecimenType::all();
        return view('histo',['histos'=>$histos,'specimens'=>$specimens]);
    }

    public function cyto(){
        $cytos = Cyto::with('specimenType')->search()
            ->where('is_approve','0')
            ->latest('id')
            ->paginate(10);
        $specimens = SpecimenType::all();

        return view('cyto',['cytos'=>$cytos,'specimens'=>$specimens]);
    }

}
