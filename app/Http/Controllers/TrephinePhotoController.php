<?php

namespace App\Http\Controllers;

use App\Models\TrephinePhoto;
use App\Http\Requests\StoreTrephinePhotoRequest;
use App\Http\Requests\UpdateTrephinePhotoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class TrephinePhotoController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTrephinePhotoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrephinePhotoRequest $request)
    {
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
                $photo->trephine_id = $request->trephine_id;
                $photo->user_id = Auth::id();
                $photo->save();

            }
        }


        return redirect()->back()->with('status',"Photos Added Successful.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TrephinePhoto  $trephinePhoto
     * @return \Illuminate\Http\Response
     */
    public function show(TrephinePhoto $trephinePhoto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TrephinePhoto  $trephinePhoto
     * @return \Illuminate\Http\Response
     */
    public function edit(TrephinePhoto $trephinePhoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTrephinePhotoRequest  $request
     * @param  \App\Models\TrephinePhoto  $trephinePhoto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTrephinePhotoRequest $request, TrephinePhoto $trephinePhoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TrephinePhoto  $trephinePhoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrephinePhoto $trephinePhoto)
    {
        // delete local file
        Storage::delete('public/trephine_photos/'.$trephinePhoto->name);
        Storage::delete('public/trephine_thumbnails/'.$trephinePhoto->name);

        // delete in db
        $trephinePhoto->delete();
        return redirect()->back()->with('status','Photo Deleted Successful');
    }
}
