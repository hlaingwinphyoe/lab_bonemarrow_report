<?php

namespace App\Http\Controllers;

use App\Models\Histo;
use App\Http\Requests\StoreHistoRequest;
use App\Http\Requests\UpdateHistoRequest;
use App\Models\HistoPhoto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
        return redirect()->route('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('histo.create');
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
        $histo->age = $request->age;
        $histo->age_type = $request->age_type;
        $histo->gender = $request->gender;
        $histo->specimen_type = $request->specimen_type;
        $histo->price = $request->price;
        $histo->doctor = $request->doctor;
        $histo->bio_receive_date = $request->bio_receive_date;
        $histo->bio_cut_date = $request->bio_cut_date;
        $histo->bio_report_date = $request->bio_report_date;
        $histo->specimen = $request->specimen;
        $histo->gross = $request->gross;
        $histo->description = $request->description;
        $histo->remark = $request->remark;
        $histo->hospital_id = $request->hospital;
        $histo->user_id = Auth::id();
        $histo->save();

        if ($request->hasFile('histo_photos')){
            foreach ($request->file('histo_photos') as $photo){
                //store file
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

        return redirect()->route('index')->with('status','Histo Report Created.');

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
        return view('histo.edit',compact('histo'));
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
        $histo->age = $request->age;
        $histo->age_type = $request->age_type;
        $histo->specimen_type = $request->specimen_type;
        $histo->price = $request->price;
        $histo->gender = $request->gender;
        $histo->doctor = $request->doctor;
        $histo->bio_receive_date = $request->bio_receive_date;
        $histo->bio_cut_date = $request->bio_cut_date;
        $histo->bio_report_date = $request->bio_report_date;
        $histo->specimen = $request->specimen;
        $histo->gross = $request->gross;
        $histo->description = $request->description;
        $histo->remark = $request->remark;
        $histo->hospital_id = $request->hospital;
        $histo->user_id = Auth::id();
        $histo->update();
        return redirect()->route('index')->with('status',"Report Updated Successful.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Histo  $histo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Histo $histo)
    {
        //
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
        $invoice = Histo::where('id','=',$id)->first();
        return view('histo.invoice',compact('invoice'));
    }

}
