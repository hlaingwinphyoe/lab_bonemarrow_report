<?php

namespace App\Http\Controllers;

use App\Exports\HistosExport;
use App\Models\Histo;
use App\Http\Requests\StoreHistoRequest;
use App\Http\Requests\UpdateHistoRequest;
use App\Models\Hospital;
use App\Models\SpecimenType;
use App\Models\User;
use App\Notifications\HistoJobCreatedNotification;
use App\Notifications\HistoResultAddNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class HistoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['permission:access histo'], ['only' => ['index']]);
        $this->middleware(['permission:write histo'], ['only' => ['create']]);
        $this->middleware(['permission:edit histo'], ['only' => ['edit']]);
        $this->middleware(['permission:delete histo'], ['only' => ['destroy']]);
    }

    public function index()
    {
        $histos = Histo::with('specimenType')->search()
            ->where('is_complete','!=','0')
            ->latest('id')
            ->paginate(10);

        $specimens = SpecimenType::all();
        return view('histo.index',['histos'=>$histos,'specimens'=>$specimens]);
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
        return view('histo.create',['hospitals'=>$hospitals,'specimens'=>$specimens]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHistoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHistoRequest $request)
    {
        $histo = new Histo();
        $histo->name = $request->name;
        $histo->slug = Str::slug($request->name,'-');
        $histo->year = $request->year;
        $histo->month = $request->month;
        $histo->day = $request->day;
        $histo->gender = $request->gender;
        $histo->doctor = $request->doctor;
        $histo->bio_receive_date = $request->bio_receive_date;
        $histo->specimen_type_id = $request->specimen_type;
        $histo->hospital_id = $request->hospital;
        $histo->user_id = Auth::id();
        $histo->save();

        $users = User::role(['Admin','Gross_doctor','Micro_doctor'])->get();
        Notification::send($users,new HistoJobCreatedNotification($histo));
        return redirect()->route('histo.index')->with(['status'=>'Successfully Created!','create'=>$histo->name.' report အား Tests စစ်ဆေးပေးရန်ရှိပါသည်။']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Histo  $histo
     * @return \Illuminate\Http\Response
     */
    public function show(Histo $histo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Histo  $histo
     * @return \Illuminate\Http\Response
     */
    public function edit(Histo $histo)
    {
        $hospitals = Hospital::all();
        $specimens = SpecimenType::all();

        return view('histo.edit',compact('histo','hospitals','specimens'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHistoRequest  $request
     * @param  \App\Models\Histo  $histo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHistoRequest $request, Histo $histo)
    {
        $histo->name = $request->name;
        $histo->slug = Str::slug($request->name,'-');
        $histo->year = $request->year;
        $histo->month = $request->month;
        $histo->day = $request->day;
        $histo->gender = $request->gender;
        $histo->doctor = $request->doctor;
        $histo->bio_receive_date = $request->bio_receive_date;
        $histo->bio_cut_date = $request->bio_cut_date;
        $histo->bio_report_date = $request->bio_report_date;
        $histo->specimen = $request->specimen;
        $histo->gross = $request->gross;
        $histo->description = $request->description;
        $histo->remark = $request->remark;
        $histo->specimen_type_id = $request->specimen_type;
        $histo->hospital_id = $request->hospital;
        $histo->user_id = Auth::id();
        if ($histo->gross== null || $histo->description == null){
            if (isset($histo->gross) || isset($histo->description))
            {
                $histo->is_complete = '1';
            }
            else{
                $histo->is_complete = '2';
            }
        }else{
            $histo->is_complete = '0';
        }

        $histo->update();
        if ($histo->is_complete == '0'){
            $users = User::role('Admin')->get();
            Notification::send($users,new HistoResultAddNotification($histo));
            return redirect()->route('histo.index')->with(['status'=>'Successfully Updated!','create'=>$histo->name.' report အား အတည်ပြုပေးရန်ရှိပါသည်။']);
        }else{
            return redirect()->route('histo.index')->with('status',"Successfully Updated!");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Histo  $histo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Histo $histo)
    {
        $histo->delete();
        return redirect()->back()->with('status',"Successfully Deleted!");

    }

    public function print($id){
        $patientFact = Histo::where('id','=',$id)->first();
        return view('histo.print',compact('patientFact'));
    }
    public function withoutHeaderPrint($id){
        $patientFact = Histo::where('id','=',$id)->first();
        return view('histo.without-header-print',compact('patientFact'));
    }

    public function invoice($id){
        $invoice = Histo::where('id',$id)->first();
        return view('histo.invoice',compact('invoice'));
    }

    public function export(){
        return Excel::download(new HistosExport, 'histos.xlsx');
    }

}
