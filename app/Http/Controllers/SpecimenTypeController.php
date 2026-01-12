<?php

namespace App\Http\Controllers;

use App\Models\SpecimenType;
use App\Http\Requests\StoreSpecimenTypeRequest;
use App\Http\Requests\UpdateSpecimenTypeRequest;
use Illuminate\Support\Facades\Auth;

class SpecimenTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:access specimen'], ['only' => ['create']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specimens = SpecimenType::all();
        return view('specimen_type.create',['specimens'=>$specimens]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSpecimenTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSpecimenTypeRequest $request)
    {
        $specimenType = new SpecimenType();
        $specimenType->name = $request->name;
        $specimenType->price = $request->price;
        $specimenType->user_id = Auth::id();
        $specimenType->save();

        return redirect()->back()->with('status',"Successfully Created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SpecimenType  $specimenType
     * @return \Illuminate\Http\Response
     */
    public function show(SpecimenType $specimenType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SpecimenType  $specimenType
     * @return \Illuminate\Http\Response
     */
    public function edit(SpecimenType $specimenType)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSpecimenTypeRequest  $request
     * @param  \App\Models\SpecimenType  $specimenType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSpecimenTypeRequest $request, SpecimenType $specimenType)
    {
        $specimenType->name = $request->name;
        $specimenType->price = $request->price;
        $specimenType->user_id = Auth::id();
        $specimenType->update();

        return redirect()->back()->with('status',"Successfully Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SpecimenType  $specimenType
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpecimenType $specimenType)
    {
        $specimenType->delete();
        return redirect()->back()->with('status',"Successfully Deleted!");
    }
}
