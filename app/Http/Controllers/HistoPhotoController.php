<?php

namespace App\Http\Controllers;

use App\Models\HistoPhoto;
use App\Http\Requests\StoreHistoPhotoRequest;
use App\Http\Requests\UpdateHistoPhotoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class HistoPhotoController extends Controller
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
     * @param  \App\Http\Requests\StoreHistoPhotoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHistoPhotoRequest $request)
    {
        if ($request->hasFile('histo_photos')){
            if (!Storage::exists('public/histo_thumbnails')){
                Storage::makeDirectory('public/histo_thumbnails');
            }
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
     * @param  \App\Models\HistoPhoto  $histoPhoto
     * @return \Illuminate\Http\Response
     */
    public function show(HistoPhoto $histoPhoto)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HistoPhoto  $histoPhoto
     * @return \Illuminate\Http\Response
     */
    public function edit(HistoPhoto $histoPhoto)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHistoPhotoRequest  $request
     * @param  \App\Models\HistoPhoto  $histoPhoto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHistoPhotoRequest $request, HistoPhoto $histoPhoto)
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HistoPhoto  $histoPhoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(HistoPhoto $histoPhoto)
    {
        // delete local file
        Storage::delete('public/histo_photos/'.$histoPhoto->name);
        Storage::delete('public/histo_thumbnails/'.$histoPhoto->name);

        // delete in db
        $histoPhoto->delete();
        return redirect()->back()->with('status','Successfully Deleted!');
    }
}
