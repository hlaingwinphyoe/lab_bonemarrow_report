<?php

namespace App\Http\Controllers;

use App\Models\Aspirate;
use App\Http\Requests\StoreAspirateRequest;
use App\Http\Requests\UpdateAspirateRequest;
use App\Models\AspiratePhoto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AspirateController extends Controller
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
        return view('aspirate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAspirateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAspirateRequest $request)
    {
        $aspirate = new Aspirate();
        $aspirate->sc_date = $request->sc_date;
        $aspirate->lab_access = $request->lab_access;
        $aspirate->patient_name = $request->patient_name;
        $aspirate->slug = Str::slug($request->patient_name,'-');
        $aspirate->age = $request->age;
        $aspirate->age_type = $request->age_type;
        $aspirate->gender = $request->gender;
        $aspirate->contact_detail = $request->contact_detail;
        $aspirate->physician_name = $request->physician_name;
        $aspirate->doctor = $request->doctor;
        $aspirate->clinical_history = $request->clinical_history;
        $aspirate->bmexamination = $request->bmexamination;
        $aspirate->pro_perform = $request->pro_perform;
        $aspirate->anatomic_site_aspirate = $request->anatomic_site_aspirate;
        $aspirate->ease_diff_aspirate = $request->ease_diff_aspirate;
        $aspirate->blood_count = $request->blood_count;
        $aspirate->blood_smear = $request->blood_smear;
        $aspirate->cellular_particles = $request->cellular_particles;
        $aspirate->nucleated_differential = $request->nucleated_differential;
        $aspirate->total_cell_count = $request->total_cell_count;
        $aspirate->myeloid = $request->myeloid;
        $aspirate->erythropoiesis = $request->erythropoiesis;
        $aspirate->myelopoiesis = $request->myelopoiesis;
        $aspirate->megakaryocytes = $request->megakaryocytes;
        $aspirate->lymphocytes = $request->lymphocytes;
        $aspirate->plasma_cell = $request->plasma_cell;
        $aspirate->haemopoietic_cell = $request->haemopoietic_cell;
        $aspirate->abnormal_cell = $request->abnormal_cell;
        $aspirate->iron_stain = $request->iron_stain;
        $aspirate->cytochemistry = $request->cytochemistry;
        $aspirate->investigation = $request->investigation;
        $aspirate->flow_cytometry = $request->flow_cytometry;
        $aspirate->conclusion = $request->conclusion;
        $aspirate->classification = $request->classification;
        $aspirate->disease_code = $request->disease_code;
        $aspirate->hospital_id = $request->hospital;
        $aspirate->user_id = Auth::id();
        $aspirate->save();

        if ($request->hasFile('aspirate_photos')){
            foreach ($request->file('aspirate_photos') as $photo){
                //store file
                $newName =uniqid()."_aspirate.".$photo->extension();
                $photo->storeAs('public/aspirate_photos/',$newName);

                // making thumbnail
                $img = Image::make($photo);
                // reduce size
                $img->fit(200,200);
                $img->save('storage/aspirate_thumbnails/'.$newName);  // public folder

                // store db
                $photo = new AspiratePhoto();
                $photo->name = $newName;
                $photo->aspirate_id = $aspirate->id;
                $photo->user_id = Auth::id();
                $photo->save();

            }
        }


        return redirect()->route('index')->with('status',"Aspirate Report Submitted.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aspirate  $aspirate
     * @return \Illuminate\Http\Response
     */
    public function show(Aspirate $aspirate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aspirate  $aspirate
     * @return \Illuminate\Http\Response
     */
    public function edit(Aspirate $aspirate)
    {
        Gate::authorize('update',$aspirate);
        return view('aspirate.edit',compact('aspirate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAspirateRequest  $request
     * @param  \App\Models\Aspirate  $aspirate
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAspirateRequest $request, Aspirate $aspirate)
    {
        $aspirate->sc_date = $request->sc_date;
        $aspirate->lab_access = $request->lab_access;
        $aspirate->patient_name = $request->patient_name;
        $aspirate->slug = Str::slug($request->patient_name,'-');
        $aspirate->age = $request->age;
        $aspirate->age_type = $request->age_type;
        $aspirate->gender = $request->gender;
        $aspirate->contact_detail = $request->contact_detail;
        $aspirate->physician_name = $request->physician_name;
        $aspirate->doctor = $request->doctor;
        $aspirate->clinical_history = $request->clinical_history;
        $aspirate->bmexamination = $request->bmexamination;
        $aspirate->pro_perform = $request->pro_perform;
        $aspirate->anatomic_site_aspirate = $request->anatomic_site_aspirate;
        $aspirate->ease_diff_aspirate = $request->ease_diff_aspirate;
        $aspirate->blood_count = $request->blood_count;
        $aspirate->blood_smear = $request->blood_smear;
        $aspirate->cellular_particles = $request->cellular_particles;
        $aspirate->nucleated_differential = $request->nucleated_differential;
        $aspirate->total_cell_count = $request->total_cell_count;
        $aspirate->myeloid = $request->myeloid;
        $aspirate->erythropoiesis = $request->erythropoiesis;
        $aspirate->myelopoiesis = $request->myelopoiesis;
        $aspirate->megakaryocytes = $request->megakaryocytes;
        $aspirate->lymphocytes = $request->lymphocytes;
        $aspirate->plasma_cell = $request->plasma_cell;
        $aspirate->haemopoietic_cell = $request->haemopoietic_cell;
        $aspirate->abnormal_cell = $request->abnormal_cell;
        $aspirate->iron_stain = $request->iron_stain;
        $aspirate->cytochemistry = $request->cytochemistry;
        $aspirate->investigation = $request->investigation;
        $aspirate->flow_cytometry = $request->flow_cytometry;
        $aspirate->conclusion = $request->conclusion;
        $aspirate->classification = $request->classification;
        $aspirate->disease_code = $request->disease_code;
        $aspirate->hospital_id = $request->hospital;
        $aspirate->update();

        return redirect()->route('index')->with('status','Report Updated Successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aspirate  $aspirate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aspirate $aspirate)
    {
        //
    }

    // Print Section
    public function print($patientName){
        $patientFact = Aspirate::where('slug','=',$patientName)->first();
        return view('aspirate.print',compact('patientFact'));
    }

    public function withoutHeaderPrint($patientName){
        $patientFact = Aspirate::where('slug','=',$patientName)->first();
        return view('aspirate.without-header-print',compact('patientFact'));
    }

}
