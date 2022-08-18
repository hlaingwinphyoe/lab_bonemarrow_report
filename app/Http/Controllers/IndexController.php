<?php

namespace App\Http\Controllers;

use App\Models\Aspirate;
use App\Models\Cyto;
use App\Models\Histo;
use App\Models\Trephine;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $aspirates = Aspirate::when(isset(request()->search),function ($query){
            $search = request()->search;
            $query->where('patient_name','LIKE',"%$search%")->orwhere('sc_date','LIKE',"%$search%");
        })->latest('id')
            ->paginate(10,['*'],'aspiratePage');

        return view('index',['aspirates'=>$aspirates]);
    }

    public function trephine(){
        $trephines = Trephine::when(isset(request()->search),function ($query){
            $search = request()->search;
            $query->where('patient_name','LIKE',"%$search%")->orwhere('sc_date','LIKE',"%$search%");
        })->latest('id')
            ->paginate(10,['*'],'trephinePage');
        return view('trephine',['trephines'=>$trephines]);
    }

    public function histo(){
        $histos = Histo::when(isset(request()->search),function ($query){
            $search = request()->search;
            $query->where('name','LIKE',"%$search%")->orwhere('bio_receive_date','LIKE',"%$search%")->orwhere('bio_cut_date','LIKE',"%$search%")->orwhere('bio_report_date','LIKE',"%$search%");
        })->latest('id')
            ->paginate(10,['*'],'histoPage');
        return view('histo',['histos'=>$histos]);
    }

    public function cyto(){
        $cytos = Cyto::when(isset(request()->search),function ($query){
            $search = request()->search;
            $query->where('name','LIKE',"%$search%")->orwhere('bio_receive_date','LIKE',"%$search%")->orwhere('bio_cut_date','LIKE',"%$search%")->orwhere('bio_report_date','LIKE',"%$search%");
        })->latest('id')
            ->paginate(10,['*'],'cytoPage');
        return view('cyto',['cytos'=>$cytos]);
    }
}
