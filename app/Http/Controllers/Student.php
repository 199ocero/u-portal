<?php

namespace App\Http\Controllers;

use App\Models\Drop;
use App\Models\User;
use App\Models\Complete;
use App\Models\Facebook;
use App\Models\Irregular;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Models\StudentSection;
use App\Rules\MatchOldPassword;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\InstructorSectionSubject;

class Student extends Controller
{
    
    public function viewAnnouncement(){
        $drop = Drop::where('student_id',Auth::id())->get();
        $student = StudentSection::where('student_id',Auth::id())->get()->toArray();
        $irregular = Irregular::where('student_id',Auth::id())->get()->toArray();
        $complete = Complete::where('student_id',Auth::id())->get()->toArray();
        $type = array();
        $announcement= collect();
        $status = array();

        if(count($drop)!=0){

            $section_id = [];
            $subject_id = [];
            foreach($drop as $drop){
                $section_id[]=$drop->section_id;
                $subject_id[]=$drop->subject_id;
            }
            $announcement = Announcement::whereNotIn('section_id',$section_id)->whereNotIn('subject_id',$subject_id)->get();

            for($i=0;$i<count($announcement);$i++){
                for($y=0;$y<count($irregular);$y++){
                    if($irregular[$y]['section_id']==$announcement[0]['section_id'] && $irregular[$y]['subject_id']==$announcement[0]['subject_id']){
                        array_push($type,'Irregular');
                        break;
                    }else{
                        array_push($type,'Regular');
                        break;
                    }
                }

            }
            
        }else{
            for($i=0;$i<count($student);$i++){
                $announce = Announcement::where('section_id',$student[$i]['section_id'])->get();
    
                for($x=0;$x<count($announce);$x++){
                    $announcement->push($announce[$x]);
                    $announces = Announcement::where('section_id',$student[$i]['section_id'])->get()->toArray();
                    for($y=0;$y<count($irregular);$y++){
                        if($irregular[$y]['section_id']==$announces[0]['section_id'] && $irregular[$y]['subject_id']==$announces[0]['subject_id']){
                            array_push($type,'Irregular');
                            break;
                        }else{
                            array_push($type,'Regular');
                            break;
                        }
                    }
                }
                
            }
        }
        if(count($complete)==0){
            for($y=0;$y<count($announcement);$y++){
                array_push($status,'Incomplete');
            }
        }else{
            for($y=0;$y<count($announcement->toArray());$y++){
                array_push($status,'Incomplete');
            }
            for($i=0;$i<count($announcement->toArray());$i++){
            
                for($y=0;$y<count($complete);$y++){
                    if($complete[$y]['announcement_id']==$announcement[$i]['id']){
                        // array_push($index,$i);
                        $status[$i] = 'Complete';
                        break;
                    }
                }
            }
        }
        
       
        
        return view('pages.student.view-announcement',compact('announcement','type','status'));
    }
    public function viewAnnouncementDetails($id){
        $announcement = Announcement::find($id);
        return view('pages.student.details-announcement',compact('announcement'));
    }
    //Profile
    public function viewProfile(){
        $user = User::find(Auth::id());
        return view('pages.student.profile.view-profile',compact('user'));
    }
    public function viewEditProfile(){
        $student = User::find(Auth::id());
        return view('pages.student.profile.edit-profile',compact('student'));
    }
    public function viewUpdateProfile(Request $request){
        $student = User::find(Auth::id());
        
        $validateData = $request->validate([
            'first_name' => ['required', 'max:255'],
            'middle_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'username' => [
                'required',
                Rule::unique('users')->ignore($student->id),
            ],
            'email' => [
                'required',
                Rule::unique('users')->ignore($student->id),
            ],
        ]);
        $student->username = $request->username;
        $student->first_name = $request->first_name;
        $student->middle_name = $request->middle_name;
        $student->last_name = $request->last_name;
        $student->email = $request->email;
        $student->update();

        return redirect()->route('view.profile.student')->with('success','Profile Updated!');
    }
    public function viewPassword(){
        return view('pages.student.password.view-password');
    }
    public function viewChangePassword(Request $request){
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'password' => ['required'],
            'password_confirmation' => ['same:password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->password)]);
  
        return back()->with('success', 'Password Changed!');
    }
    public function viewActComplete($id){
        $complete = new Complete();
        $complete->student_id = Auth::id();
        $complete->announcement_id = $id;
        $complete->save();
        return redirect()->route('view.announcement')->with('success','Activity Completed!');
    }
    public function viewActIncomplete($id){
        $complete = Complete::where('announcement_id',$id)->first()->delete();
        return redirect()->route('view.announcement')->with('success','Activity Incompleted!');
    }
}
