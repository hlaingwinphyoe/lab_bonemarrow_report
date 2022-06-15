<?php

namespace App\Http\Controllers;

use App\Models\Trephine;
use App\Http\Requests\StoreTrephineRequest;
use App\Http\Requests\UpdateTrephineRequest;
use App\Models\TrephinePhoto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class TrephineController extends Controller
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
        return view('trephine.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTrephineRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrephineRequest $request)
    {
        $trephine = new Trephine();
        $trephine->sc_date = $request->sc_date;
        $trephine->lab_access = $request->lab_access;
        $trephine->patient_name = $request->patient_name;
        $trephine->slug = Str::slug($request->patient_name,'-');
        $trephine->age = $request->age;
        $trephine->age_type = $request->age_type;
        $trephine->gender = $request->gender;
        $trephine->contact_detail = $request->contact_detail;
        $trephine->physician_name = $request->physician_name;
        $trephine->doctor = $request->doctor;
        $trephine->clinical_history = $request->clinical_history;
        $trephine->bmexamination = $request->bmexamination;
        $trephine->pro_perform = $request->pro_perform;
        $trephine->anatomic_site_trephine = $request->anatomic_site_trephine;
        $trephine->biopsy_core = $request->biopsy_core;
        $trephine->ade_macro_appearance = $request->ade_macro_appearance;
        $trephine->percentage_cellularity = $request->percentage_cellularity;
        $trephine->bone_architecture = $request->bone_architecture;
        $trephine->path = $request->path;
        $trephine->tre_number = $request->tre_number;
        $trephine->erythroid = $request->erythroid;
        $trephine->myeloid = $request->myeloid;
        $trephine->megaka = $request->megaka;
        $trephine->lymphoid = $request->lymphoid;
        $trephine->plasma_cell = $request->plasma_cell;
        $trephine->macrophages = $request->macrophages;
        $trephine->abnormal_cell = $request->abnormal_cell;
        $trephine->reticulin_stain = $request->reticulin_stain;
        $trephine->immunohistochemistry = $request->immunohistochemistry;
        $trephine->histochemistry = $request->histochemistry;
        $trephine->investigation = $request->investigation;
        $trephine->conclusion = $request->conclusion;
        $trephine->disease_code = $request->disease_code;
        $trephine->hospital_id = $request->hospital;
        $trephine->user_id = Auth::id();
        $trephine->save();

        if ($request->hasFile('trephine_photos')){
            foreach ($request->file('trephine_photos') as $photo){
                //store file
                $newName =uniqid()."_trephine.".$photo->extension();
                $photo->storeAs('public/trephine_photos/',$newName);

                // making thumbnail
                $img = Image::make($photo);
                // reduce size
                $img->fit(200,200);
                $img->save('storage/trephine_thumbnails/'.$newName);  // public folder

                // store db
                $photo = new TrephinePhoto();
                $photo->name = $newName;
                $photo->trephine_id = $trephine->id;
                $photo->user_id = Auth::id();
                $photo->save();

            }
        }


        return redirect()->route('index')->with('status',"Trephine Report Submitted.");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trephine  $trephine
     * @return \Illuminate\Http\Response
     */
    public function show(Trephine $trephine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trephine  $trephine
     * @return \Illuminate\Http\Response
     */
    public function edit(Trephine $trephine)
    {
        return view('trephine.edit',compact('trephine'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTrephineRequest  $request
     * @param  \App\Models\Trephine  $trephine
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTrephineRequest $request, Trephine $trephine)
    {
        $trephine->sc_date = $request->sc_date;
        $trephine->lab_access = $request->lab_access;
        $trephine->patient_name = $request->patient_name;
        $trephine->slug = Str::slug($request->patient_name,'-');
        $trephine->age = $request->age;
        $trephine->age_type = $request->age_type;
        $trephine->gender = $request->gender;
        $trephine->contact_detail = $request->contact_detail;
        $trephine->physician_name = $request->physician_name;
        $trephine->doctor = $request->doctor;
        $trephine->clinical_history = $request->clinical_history;
        $trephine->bmexamination = $request->bmexamination;
        $trephine->pro_perform = $request->pro_perform;
        $trephine->anatomic_site_trephine = $request->anatomic_site_trephine;
        $trephine->biopsy_core = $request->biopsy_core;
        $trephine->ade_macro_appearance = $request->ade_macro_appearance;
        $trephine->percentage_cellularity = $request->percentage_cellularity;
        $trephine->bone_architecture = $request->bone_architecture;
        $trephine->path = $request->path;
        $trephine->tre_number = $request->tre_number;
        $trephine->erythroid = $request->erythroid;
        $trephine->myeloid = $request->myeloid;
        $trephine->megaka = $request->megaka;
        $trephine->lymphoid = $request->lymphoid;
        $trephine->plasma_cell = $request->plasma_cell;
        $trephine->macrophages = $request->macrophages;
        $trephine->abnormal_cell = $request->abnormal_cell;
        $trephine->reticulin_stain = $request->reticulin_stain;
        $trephine->immunohistochemistry = $request->immunohistochemistry;
        $trephine->histochemistry = $request->histochemistry;
        $trephine->investigation = $request->investigation;
        $trephine->conclusion = $request->conclusion;
        $trephine->disease_code = $request->disease_code;
        $trephine->hospital_id = $request->hospital;
        $trephine->update();

        return redirect()->route('index')->with('status',"Report Updated Successful.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trephine  $trephine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trephine $trephine)
    {
        //
    }

    public function print($patientName){
        $patientFact = Trephine::where('slug','=',$patientName)->first();
        return view('trephine.print',compact('patientFact'));
    }

    public function withoutHeaderPrint($patientName){
        $patientFact = Trephine::where('slug','=',$patientName)->first();
        return view('trephine.without-header-print',compact('patientFact'));
    }

}
