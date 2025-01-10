<?php

namespace App\Http\Controllers;

use App\Models\HistoGross;
use App\Http\Requests\StoreHistoGrossRequest;
use App\Http\Requests\UpdateHistoGrossRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class HistoGrossController extends Controller
{
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
        return abort(404);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHistoGrossRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHistoGrossRequest $request)
    {
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
                $photo->histo_id = $request->histo_id;
                $photo->user_id = Auth::id();
                $photo->save();

            }
        }

        return redirect()->back()->with('status','Successfully Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HistoGross  $histoGross
     * @return \Illuminate\Http\Response
     */
    public function show(HistoGross $histoGross)
    {
        return abort(404);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HistoGross  $histoGross
     * @return \Illuminate\Http\Response
     */
    public function edit(HistoGross $histoGross)
    {
        return abort(404);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHistoGrossRequest  $request
     * @param  \App\Models\HistoGross  $histoGross
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHistoGrossRequest $request, HistoGross $histoGross)
    {
        return abort(404);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HistoGross  $histoGross
     * @return \Illuminate\Http\Response
     */
    public function destroy(HistoGross $histoGross)
    {
        // delete local file
        Storage::delete('public/gross_photos/'.$histoGross->name);
        Storage::delete('public/gross_thumbnails/'.$histoGross->name);

        // delete in db
        $histoGross->delete();
        return redirect()->back()->with('status','Successfully Deleted!');
    }
}
