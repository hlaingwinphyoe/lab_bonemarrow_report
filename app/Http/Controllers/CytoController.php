<?php

namespace App\Http\Controllers;

use App\Models\Cyto;
use App\Http\Requests\StoreCytoRequest;
use App\Http\Requests\UpdateCytoRequest;
use App\Models\CytoPhoto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CytoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cyto.create');
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
        $cyto->age = $request->age;
        $cyto->age_type = $request->age_type;
        $cyto->specimen_type = $request->specimen_type;
        $cyto->price = $request->price;
        $cyto->gender = $request->gender;
        $cyto->doctor = $request->doctor;
        $cyto->bio_receive_date = $request->bio_receive_date;
        $cyto->bio_cut_date = $request->bio_cut_date;
        $cyto->bio_report_date = $request->bio_report_date;
        $cyto->specimen = $request->specimen;
        $cyto->morphology = $request->morphology;
        $cyto->cyto_diagnosis = $request->cyto_diagnosis;
        $cyto->hospital_id = $request->hospital;
        $cyto->user_id = Auth::id();
        $cyto->save();

        if ($request->hasFile('cyto_photos')){
            foreach ($request->file('cyto_photos') as $photo){
                //store file
                $newName =uniqid()."_cyto.".$photo->extension();
                $photo->storeAs('public/cyto_photos/',$newName);

                // making thumbnail
                $img = Image::make($photo);
                // reduce size
                $img->fit(200,200);
                $img->save('storage/cyto_thumbnails/'.$newName);  // public folder

                // store db
                $photo = new CytoPhoto();
                $photo->name = $newName;
                $photo->cyto_id = $cyto->id;
                $photo->user_id = Auth::id();
                $photo->save();

            }
        }

        return redirect()->route('index')->with('status','Cyto Report Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cyto  $cyto
     * @return \Illuminate\Http\Response
     */
    public function show(Cyto $cyto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cyto  $cyto
     * @return \Illuminate\Http\Response
     */
    public function edit(Cyto $cyto)
    {
        return view('cyto.edit',compact('cyto'));
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
        $cyto->age = $request->age;
        $cyto->age_type = $request->age_type;
        $cyto->gender = $request->gender;
        $cyto->specimen_type = $request->specimen_type;
        $cyto->price = $request->price;
        $cyto->doctor = $request->doctor;
        $cyto->bio_receive_date = $request->bio_receive_date;
        $cyto->bio_cut_date = $request->bio_cut_date;
        $cyto->bio_report_date = $request->bio_report_date;
        $cyto->specimen = $request->specimen;
        $cyto->morphology = $request->morphology;
        $cyto->cyto_diagnosis = $request->cyto_diagnosis;
        $cyto->hospital_id = $request->hospital;
        $cyto->user_id = Auth::id();
        $cyto->update();
        return redirect()->route('index')->with('status',"Report Updated Successful.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cyto  $cyto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cyto $cyto)
    {
        //
    }

    public function print($patientName){
        $patientFact = Cyto::where('slug','=',$patientName)->first();
        return view('cyto.print',compact('patientFact'));
    }

    public function withoutHeaderPrint($patientName){
        $patientFact = Cyto::where('slug','=',$patientName)->first();
        return view('cyto.without-header-print',compact('patientFact'));
    }

    // Invoice
    public function invoice($id){
        $invoice = Cyto::where('id','=',$id)->first();
        return view('cyto.invoice',compact('invoice'));
    }

}
