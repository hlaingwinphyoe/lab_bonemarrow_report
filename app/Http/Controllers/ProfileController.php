<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Testing\Fluent\Concerns\Has;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile(){
        return view("user-profile.profile");
    }

    public function changePassword(Request $request){

        $request->validate([

            'current_password' => 'required',

            'new_password' => 'required|min:8',

            'new_confirm_password' => 'required_with:new_password|same:new_password|min:8',

        ]);

        $hashedPassword = Auth::user()->password;
        if (!Hash::check($request->current_password , $hashedPassword)) {
            return redirect()->back()->with('message',"Current Password Do Not Match!");
        }
        else{
            $user = new User();

            // find current Login User
            $currentUser = $user->find(Auth::id());
            $currentUser->password = Hash::make($request->new_password);
            $currentUser->update();

            // login again
            Auth::logout();
            return redirect()->route("login")->with('status',"Successfully Changed!");
        }

    }

    public function changeName(Request $request){

        $request->validate([
            "name" => 'min:3|max:50',
        ]);

        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->update();

        return redirect()->back()->with("success","Successfully Changed!");
    }

    public function changeEmail(Request $request){
        $request->validate([
            'email' => 'required|email|unique:users,email|min:5|max:50',
        ]);

        $user = User::find(Auth::id());
        $user->email = $request->email;
        $user->update();

        return redirect()->back()->with("success","Successfully Changed!");

    }

    public function changePhoto(Request $request){
        $request->validate([
            "profile_photo" => "required|mimetypes:image/jpeg,image/png|file|max:2500"   // dimensions:ratio=1/1| ပုံလေးထောင့်လိုချင်ရင် ထည့်စစ်
        ]);
        $dir = "public/profile";

        Storage::delete($dir.Auth::user()->photo);

        if (!Storage::exists('public/profile_thumbnails')){
            Storage::makeDirectory('public/profile_thumbnails');
        }

        $newName = uniqid()."_user_photo.".$request->file("profile_photo")->extension();
        $request->file("profile_photo")->storeAs($dir,$newName);

        // making thumbnail
        $img = Image::make($request->file('profile_photo'));
        // reduce size
        $img->fit(200,200);
        $img->save('storage/profile_thumbnails/'.$newName);  // public folder

        $user = User::find(Auth::id());
        $user->photo = $newName;
        $user->update();
        return redirect()->back()->with("success","Successfully Changed!");
    }

    public function signature(Request $request){
        $request->validate([
            "signature" => "required|mimetypes:image/jpeg,image/png|file|max:2500"   // dimensions:ratio=1/1| ပုံလေးထောင့်လိုချင်ရင် ထည့်စစ်
        ]);
        $dir = "public/signature";

        Storage::delete($dir.Auth::user()->signature);

        $newName = uniqid()."_user_signature.".$request->file("signature")->extension();
        $request->file("signature")->storeAs($dir,$newName);

        // making thumbnail
        $img = Image::make($request->file('signature'));
        // reduce size
        $img->fit(100,80);
        $img->save('storage/signature_thumbnails/'.$newName);  // public folder

        $user = User::find(Auth::id());
        $user->signature = $newName;
        $user->update();
        return redirect()->back()->with("success","Successfully Added!");
    }

}
