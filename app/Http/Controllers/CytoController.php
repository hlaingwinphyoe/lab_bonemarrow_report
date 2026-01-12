<?php

namespace App\Http\Controllers;

use App\Exports\CytosExport;
use App\Models\Cyto;
use App\Http\Requests\StoreCytoRequest;
use App\Http\Requests\UpdateCytoRequest;
use App\Models\CytoPhoto;
use App\Models\Hospital;
use App\Models\SpecimenType;
use App\Models\User;
use App\Notifications\CytoJobCreatedNotification;
use App\Notifications\CytoResultAddNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;

class CytoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:access cyto'], ['only' => ['index']]);
        $this->middleware(['permission:write cyto'], ['only' => ['create']]);
        $this->middleware(['permission:edit cyto'], ['only' => ['edit']]);
        $this->middleware(['permission:delete cyto'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cytos = Cyto::with('specimenType')->search()
            ->where('is_complete','!=','0')
            ->latest('id')
            ->paginate(10);

        $specimens = SpecimenType::all();
        return view('cyto.index',['cytos'=>$cytos,'specimens'=>$specimens]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hospitals = Hospital::all();
        $specimens = SpecimenType::all();
        return view('cyto.create',['hospitals'=>$hospitals,'specimens'=>$specimens]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCytoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCytoRequest $request)
    {
        $cyto = new Cyto();
        $cyto->name = $request->name;
        $cyto->slug = Str::slug($request->name,'-');
        $cyto->year = $request->year;
        $cyto->month = $request->month;
        $cyto->day = $request->day;
        $cyto->gender = $request->gender;
        $cyto->doctor = $request->doctor;
        $cyto->bio_receive_date = $request->bio_receive_date;
        $cyto->specimen_type_id = $request->specimen_type;
        $cyto->hospital_id = $request->hospital;
        $cyto->user_id = Auth::id();
        $cyto->save();

        $users = User::role(['Admin','Gross_doctor','Micro_doctor'])->get();
        Notification::send($users,new CytoJobCreatedNotification($cyto));
        return redirect()->route('cyto.index')->with(['status'=>'Successfully Created!','create'=>$cyto->name.' အား Tests စစ်ဆေးပေးရန်ရှိပါသည်။']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cyto  $cyto
     * @return \Illuminate\Http\Response
     */
    public function show(Cyto $cyto)
    {
        return redirect()->route('index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cyto  $cyto
     * @return \Illuminate\Http\Response
     */
    public function edit(Cyto $cyto)
    {
        $hospitals = Hospital::all();
        $specimens = SpecimenType::all();
        return view('cyto.edit',compact('cyto','hospitals','specimens'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCytoRequest  $request
     * @param  \App\Models\Cyto  $cyto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCytoRequest $request, Cyto $cyto)
    {
        $cyto->name = $request->name;
        $cyto->slug = Str::slug($request->name,'-');
        $cyto->year = $request->year;
        $cyto->month = $request->month;
        $cyto->day = $request->day;
        $cyto->gender = $request->gender;
        $cyto->doctor = $request->doctor;
        $cyto->bio_receive_date = $request->bio_receive_date;
        $cyto->bio_cut_date = $request->bio_cut_date;
        $cyto->bio_report_date = $request->bio_report_date;
        $cyto->morphology = $request->morphology;
        $cyto->cyto_diagnosis = $request->cyto_diagnosis;
        $cyto->specimen_type_id = $request->specimen_type;
        $cyto->hospital_id = $request->hospital;
        $cyto->user_id = Auth::id();
        if ($cyto->morphology == null || $cyto->cyto_diagnosis == null){
            if (isset($cyto->morphology) || isset($cyto->cyto_diagnosis))
            {
                $cyto->is_complete = '1';
            }
            else{
                $cyto->is_complete = '2';
            }
        }else{
            $cyto->is_complete = '0';
        }
        $cyto->update();
        if ($cyto->is_complete == '0'){
            $users = User::role('Admin')->get();
            Notification::send($users,new CytoResultAddNotification($cyto));
            return redirect()->route('cyto.index')->with(['status'=>'Successfully Updated!','create'=>$cyto->name.' report အား အတည်ပြုပေးရန်ရှိပါသည်။']);
        }else{
            return redirect()->route('cyto.index')->with('status',"Successfully Updated!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cyto  $cyto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cyto $cyto)
    {
        $cyto->delete();
        $cyto->cytoPhotos()->delete();
        return redirect()->back()->with('status',"Successfully Deleted!");
    }

    public function print($id){
        $patientFact = Cyto::where('id','=',$id)->first();
        return view('cyto.print',compact('patientFact'));
    }

    public function withoutHeaderPrint($id){
        $patientFact = Cyto::where('id','=',$id)->first();
        return view('cyto.without-header-print',compact('patientFact'));
    }

    // Invoice
    public function invoice($id){
        $invoice = Cyto::where('id','=',$id)->first();
        return view('cyto.invoice',compact('invoice'));
    }

    public function export(){
        return Excel::download(new CytosExport, 'cytos.xlsx');
    }

}
