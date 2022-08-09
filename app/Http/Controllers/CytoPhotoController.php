<?php

namespace App\Http\Controllers;

use App\Models\CytoPhoto;
use App\Http\Requests\StoreCytoPhotoRequest;
use App\Http\Requests\UpdateCytoPhotoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CytoPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('index')->with('denied',"You Can Not Access This Page. Only Admin Access!");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('index')->with('denied',"You Can Not Access This Page. Only Admin Access!");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCytoPhotoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCytoPhotoRequest $request)
    {
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
                $photo->cyto_id = $request->cyto_id;
                $photo->user_id = Auth::id();
                $photo->save();

            }
        }

        return redirect()->back()->with('status','Successfully Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CytoPhoto  $cytoPhoto
     * @return \Illuminate\Http\Response
     */
    public function show(CytoPhoto $cytoPhoto)
    {
        return redirect()->route('index')->with('denied',"You Can Not Access This Page. Only Admin Access!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CytoPhoto  $cytoPhoto
     * @return \Illuminate\Http\Response
     */
    public function edit(CytoPhoto $cytoPhoto)
    {
        return redirect()->route('index')->with('denied',"You Can Not Access This Page. Only Admin Access!");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCytoPhotoRequest  $request
     * @param  \App\Models\CytoPhoto  $cytoPhoto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCytoPhotoRequest $request, CytoPhoto $cytoPhoto)
    {
        return redirect()->route('index')->with('denied',"You Can Not Access This Page. Only Admin Access!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CytoPhoto  $cytoPhoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(CytoPhoto $cytoPhoto)
    {
        // delete local file
        Storage::delete('public/cyto_photos/'.$cytoPhoto->name);
        Storage::delete('public/cyto_thumbnails/'.$cytoPhoto->name);

        // delete in db
        $cytoPhoto->delete();
        return redirect()->back()->with('status','Successfully Deleted!');
    }
}
