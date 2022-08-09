<?php

namespace App\Http\Controllers;

use App\Models\Histo;
use App\Http\Requests\StoreHistoRequest;
use App\Http\Requests\UpdateHistoRequest;
use App\Models\HistoGross;
use App\Models\HistoPhoto;
use App\Models\Hospital;
use App\Models\SpecimenType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Milon\Barcode\DNS2D;

class HistoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $histos = Histo::when(isset(request()->histoSearch),function ($query){
            $histoSearch = request()->histoSearch;
            $query->where('name','LIKE',"%$histoSearch%")->orwhere('bio_receive_date','LIKE',"%$histoSearch%")->orwhere('bio_cut_date','LIKE',"%$histoSearch%")->orwhere('bio_report_date','LIKE',"%$histoSearch%");
        })->when(Auth::user()->isUser(),fn($q)=>$q
            ->where('user_id',Auth::id()))
            ->latest('id')
            ->paginate(10,['*'],'histoPage');
        return view('histo.index',['histos'=>$histos]);
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
        $histo->bio_cut_date = $request->bio_cut_date;
        $histo->bio_report_date = $request->bio_report_date;
        $histo->specimen = $request->specimen;
        $histo->gross = $request->gross;
        $histo->description = $request->description;
        $histo->remark = $request->remark;
        $histo->specimen_type_id = $request->specimen_type;
        $histo->hospital_id = $request->hospital;
        $histo->user_id = Auth::id();
        $histo->save();

        if ($request->hasFile('gross_photos')){
            foreach ($request->file('gross_photos') as $photo){
                //store file

                if (!Storage::exists('public/gross_thumbnails')){
                    Storage::makeDirectory('public/gross_thumbnails');
                }

                $newName =uniqid()."_gross.".$photo->extension();
                $photo->storeAs('public/gross_photos/',$newName);

                // making thumbnail
                $img = Image::make($photo);
                // reduce size
                $img->fit(200,200);
                $img->save('storage/gross_thumbnails/'.$newName);  // public folder

                // store db
                $photo = new HistoGross();
                $photo->name = $newName;
                $photo->histo_id = $histo->id;
                $photo->user_id = Auth::id();
                $photo->save();

            }
        }

        if ($request->hasFile('histo_photos')){
            foreach ($request->file('histo_photos') as $photo){
                //store file

                if (!Storage::exists('public/histo_thumbnails')){
                    Storage::makeDirectory('public/histo_thumbnails');
                }
                $newName =uniqid()."_histo.".$photo->extension();
                $photo->storeAs('public/histo_photos/',$newName);

                // making thumbnail
                $img = Image::make($photo);
                // reduce size
                $img->fit(200,200);
                $img->save('storage/histo_thumbnails/'.$newName);  // public folder

                // store db
                $photo = new HistoPhoto();
                $photo->name = $newName;
                $photo->histo_id = $histo->id;
                $photo->user_id = Auth::id();
                $photo->save();

            }
        }

        return redirect()->route('histo.index')->with('status','Successfully Created!');

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
        Gate::authorize('update',$histo);
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
        $histo->update();
        return redirect()->route('histo.index')->with('status',"Successfully Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Histo  $histo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Histo $histo)
    {
        Gate::authorize('delete',$histo);
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

}
