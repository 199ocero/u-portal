<?php

namespace App\Http\Controllers;

use App\Models\Facebook;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class FacebookController extends Controller
{
    public function viewFacebookID(){
        $fbID = Facebook::where('student_id',Auth::id())->first();

        if($fbID==null){
            $fbID="No Facebook ID";
            return view('pages.student.facebook-id',compact('fbID'));
        }else{
            return view('pages.student.facebook-id',compact('fbID'));
        }
        
    }
    public function viewAddFacebookID(Request $request){
        $validateData = $request->validate([
            'facebook_id' => ['required','unique:facebooks', 'max:255'],
        ]);
        $facebook = new Facebook();
        $facebook->student_id = Auth::id();
        $facebook->facebook_id = $request->facebook_id;
        $facebook->save();
        return redirect()->route('view.facebook')->with('sucess','Facebook ID Added!');
    }
    public function viewUpdateFacebookID(Request $request){
        $facebook = Facebook::where('student_id',Auth::id())->first();
        $validateData = $request->validate([
            'facebook_id' => [
                'required',
                Rule::unique('facebooks')->ignore($facebook->facebook_id),
            ],
        ]);
        
        $facebook->facebook_id = $request->facebook_id;
        $facebook->update();
        return redirect()->route('view.facebook')->with('sucess','Facebook ID Updated!');
    }
}
