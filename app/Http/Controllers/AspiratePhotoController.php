<?php

namespace App\Http\Controllers;

use App\Models\AspiratePhoto;
use App\Http\Requests\StoreAspiratePhotoRequest;
use App\Http\Requests\UpdateAspiratePhotoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AspiratePhotoController extends Controller
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
     * @param  \App\Http\Requests\StoreAspiratePhotoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAspiratePhotoRequest $request)
    {
        if (request()->hasFile('aspirate_photos')){
            foreach (request()->file('aspirate_photos') as $photo){
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
                $photo->aspirate_id = $request->aspirate_id;
                $photo->user_id = Auth::id();
                $photo->save();
            }
            return redirect()->back()->with('status','Photos Added Successful.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AspiratePhoto  $aspiratePhoto
     * @return \Illuminate\Http\Response
     */
    public function show(AspiratePhoto $aspiratePhoto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AspiratePhoto  $aspiratePhoto
     * @return \Illuminate\Http\Response
     */
    public function edit(AspiratePhoto $aspiratePhoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAspiratePhotoRequest  $request
     * @param  \App\Models\AspiratePhoto  $aspiratePhoto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAspiratePhotoRequest $request, AspiratePhoto $aspiratePhoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AspiratePhoto  $aspiratePhoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(AspiratePhoto $aspiratePhoto)
    {
        // delete local file
        Storage::delete('public/aspirate_photos/'.$aspiratePhoto->name);
        Storage::delete('public/aspirate_thumbnails/'.$aspiratePhoto->name);

        // delete in db
        $aspiratePhoto->delete();
        return redirect()->back()->with('status','Photo Deleted Successful');
    }
}
