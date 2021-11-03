<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Drop;
use App\Models\User;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Irregular;
use App\Models\Announcement;
use App\Models\Facebook;
use Illuminate\Http\Request;
use App\Models\StudentSection;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\InstructorSectionSubject;
use BotMan\Drivers\Facebook\FacebookDriver;

class Instructor extends Controller
{
    public function viewInstructorSectionSubject(){

        $subject = Subject::all();
        $section = Section::all();
        $assign = InstructorSectionSubject::where('instructor_id',Auth::id())->get();
        
        // dd($assign->toArray());
        return view('pages.instructor.view-assign-management',compact('assign','section','subject'));
    }
    public function viewAddInstructorSectionSubject(Request $request){
        $validateData = $request->validate([
            'subject_id' => ['required','max:255'],
            'section_id' => ['required','max:255'],
        ]);

        $assign = new InstructorSectionSubject();
        $assign->subject_id = $request->subject_id;
        $assign->instructor_id = Auth::id();
        $assign->section_id = $request->section_id;
        $assign->save();

        return redirect()->route('view.instructor.section.subject')->with('success','Assign Added!');
    }
    public function viewDetailsPageInstructorSectionSubject($section_id,$subject_id){
        $assign = StudentSection::where('section_id',$section_id)->get();
        
        $irregular = Irregular::all();
        // $irregular = Irregular::where('subject_id',$subject_id)->where('instructor_id',Auth::id())->where('section_id',$section_id)->get();
        $section = Section::find($section_id);
        $subject = Subject::find($subject_id);
        $drop = Drop::all();
        
        
        $student = $assign->toArray();
        $irregs = $irregular->toArray();
        $studs = array();

        for($i=0;$i<count($student);$i++){
            for($y=0;$y<count($irregs);$y++){
                if($student[$i]['student_id']==$irregs[$y]['student_id'] && $irregs[$y]['subject_id']!=$subject_id && $irregs[$y]['instructor_id']!=Auth::id() && $irregs[$y]['section_id']==$section_id){
                    array_push($studs, $i);
                    break;     
                }
            }
        }
        
        for($i=0;$i<count($studs);$i++){
            $assign->forget($studs[$i]);
        }
        $assign = $assign->values();
        $status = array();
        $student = $assign->toArray();
        $irregs = $irregular->toArray();
        $drops = $drop->toArray();


        
        for($i=0;$i<count($student);$i++){
            array_push($status, 'Regular');
        }

        
        
        for($i=0;$i<count($student);$i++){
            
            for($y=0;$y<count($irregs);$y++){
                if($student[$i]['student_id']==$irregs[$y]['student_id']){
                    if($student[$i]['section_id']==$irregs[$y]['section_id']){
                        $status[$i]='Irregular';
                        break;
                    }
                }
            }
        }
        for($i=0;$i<count($student);$i++){
            
            for($y=0;$y<count($drops);$y++){
                if($student[$i]['student_id']==$drops[$y]['student_id']){
                    if($student[$i]['section_id']==$drops[$y]['section_id']){
                        $status[$i]='Drop';
                        break;
                    }
                }
            }
        }
        
        // // // dd($status);
        return view('pages.instructor.details-management',compact('assign','section','subject','status'));
    }

    public function viewAddPageStudentSection($section_id,$subject_id){
        $subjectID = $subject_id;
        $sectionID = $section_id;
        $assign = User::whereRoleIs('student')->get();
        $studentSection = StudentSection::where('section_id',$section_id)->get();

        $assigns = $assign->toArray();
        $studentSections = $studentSection->toArray();
        $studentRemove = array();


        for($i=0;$i<count($studentSections);$i++){
            for($x=0;$x<count($assigns);$x++){
                if($assigns[$x]['id']==$studentSection[$i]['student_id']){
                    // array_push($studentRemove,$studentSection[$i]['student_id']);
                    $assign->forget($x);
                    break;
                }
            }
            
            
        }
        
        $assign=$assign->values();
        
        

        // dd($assign->toArray());
        return view('pages.instructor.create-student',compact('subjectID','sectionID','assign'));
    }
    public function viewAddStudentSection(Request $request, $section_id,$subject_id){
        
        $validateData = $request->validate([
            'first_name' => ['required', 'max:255'],
            'middle_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'username' => ['required','unique:users','max:255'],
            'email' => ['required','unique:users','max:255']
        ]);

        $password = Carbon::now()->format('m-d-Y');
        $student = new User();
        $student->username = $request->username;
        $student->first_name = $request->first_name;
        $student->middle_name = $request->middle_name;
        $student->last_name = $request->last_name;
        $student->email = $request->email;
        $student->password= Hash::make($password.'-'.$request->username);
        $student->save();
        $student->attachRole($request->role_id);

        $studentSection = new StudentSection();
        $studentSection->section_id=$section_id;
        $studentSection->student_id=$student->id;
        $studentSection->save();

        $irregular = new Irregular();
        $irregular->section_id=$section_id;
        $irregular->student_id=$student->id;
        $irregular->subject_id=$subject_id;
        $irregular->instructor_id=Auth::id();
        $irregular->save();


        return redirect()->to('instructor/assign/section-subject/details/'.$section_id.'/'.$subject_id)->with('success','Student Added!');
    }
    
    public function viewAddIrregularStudentSection($section_id,$subject_id,$id){

        $studentSection = new StudentSection();
        $studentSection->section_id=$section_id;
        $studentSection->student_id=$id;
        $studentSection->save();

        $irregular = new Irregular();
        $irregular->section_id=$section_id;
        $irregular->student_id=$id;
        $irregular->subject_id=$subject_id;
        $irregular->instructor_id=Auth::id();
        $irregular->save();
        
        return redirect()->to('instructor/assign/section-subject/details/'.$section_id.'/'.$subject_id)->with('success','Student Added!');
    }

    public function viewEditStudentSection($student_id,$section_id){
        $student = User::find($student_id);
        $sectionID = $section_id;
        $studentSubject = InstructorSectionSubject::where('section_id', $section_id)->first();
        return view('pages.instructor.edit-student',compact('student','sectionID','studentSubject'));
    }
    public function viewUpdateStudentSection(Request $request, $student_id,$section_id){
        $student = User::find($student_id);
        $studentSubject = InstructorSectionSubject::where('section_id', $section_id)->first()->toArray();
        
        
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

        return redirect()->to('instructor/assign/section-subject/details/'.$section_id.'/'.$studentSubject['subject_id'])->with('success','Student Updated!');
    }
    public function viewDeleteStudentSection($student_id,$section_id,$subject_id){
        StudentSection::where('student_id',$student_id)->delete();
        Irregular::where('student_id',$student_id)->delete();
        Drop::where('student_id',$student_id)->delete();
        User::find($student_id)->delete();


        return redirect()->to('instructor/assign/section-subject/details/'.$section_id.'/'.$subject_id)->with('success','Student Deleted!');
    }
    public function viewDropStudentSection($student_id,$section_id,$subject_id){
        $drop = new Drop();
        $drop->student_id = $student_id;
        $drop->section_id = $section_id;
        $drop->subject_id = $subject_id;
        $drop->save();

        return redirect()->to('instructor/assign/section-subject/details/'.$section_id.'/'.$subject_id)->with('success','Student Drop!');
    }
    public function viewUndropStudentSection($student_id,$section_id,$subject_id){
        Drop::where('student_id',$student_id)->where('section_id',$section_id)->where('subject_id',$subject_id)->delete();
        return redirect()->to('instructor/assign/section-subject/details/'.$section_id.'/'.$subject_id)->with('success','Student Added!');
    }
    public function viewDeleteInstructorSectionSubject($id,$section_id,$subject_id){
        InstructorSectionSubject::find($id)->delete();
        Announcement::where('section_id',$section_id)->where('subject_id',$subject_id)->delete();
        
        $student = Irregular::where('section_id',$section_id)->get()->toArray();

        for($i=0;$i<count($student);$i++){
            
            User::find($student[$i]['student_id'])->delete();
            Irregular::where('student_id',$student[$i]['student_id'])->delete();
            StudentSection::where('student_id',$student[$i]['student_id'])->delete();
        }
        return redirect()->route('view.instructor.section.subject')->with('success','Assign Deleted Successfully!');
    }

    public function viewRemoveIrregStudent($student_id,$section_id,$subject_id){
        Irregular::where('student_id',$student_id)->where('subject_id',$subject_id)->where('instructor_id',Auth::id())->where('section_id',$section_id)->delete();
        StudentSection::where('student_id',$student_id)->where('section_id',$section_id)->delete();
        return redirect()->to('instructor/assign/section-subject/details/'.$section_id.'/'.$subject_id)->with('success','Irregular Remove!');
    }

    //Announcement
    public function viewAnnouncement($section_id,$subject_id){
        $section_id = $section_id;
        $subject_id = $subject_id;
        $section = Section::find($section_id);
        $subject = Subject::find($subject_id);
        $announcement = Announcement::where('section_id',$section_id)->where('subject_id',$subject_id)->get();
        
        // dd($section->toArray());
        return view('pages.instructor.announcement.view-announcement',compact('section_id','subject_id','announcement','section','subject'));
    }
    public function viewAddPageAnnouncement($section_id,$subject_id){
        $section_id = $section_id;
        $subject_id = $subject_id;
        
        return view('pages.instructor.announcement.create-announcement',compact('section_id','subject_id'));
    }
    public function viewAddAnnouncement(Request $request,$section_id,$subject_id){
        $validateData = $request->validate([
            'deadline' => ['required'],
            'act_title' => ['required'],
            'instruction' => ['required'],
            'resources' => ['required'],
        ]);
       
        $announcement = new Announcement();
        $announcement->section_id = $section_id;
        $announcement->subject_id = $subject_id;
        $announcement->deadline = Carbon::parse($request->deadline);
        $announcement->act_title = $request->act_title;
        $announcement->instruction = $request->instruction;
        $announcement->resources = $request->resources;
        $announcement->save();

        $botman = app('botman');
        

        // $announce = Announcement::find($announcement->id);

        
        $assign = InstructorSectionSubject::where('subject_id',$subject_id)->where('instructor_id',Auth::id())->where('section_id',$section_id)->first();
        $studentSection = StudentSection::where('section_id',$assign->section_id)->get();
        $student_id = [];
        foreach($studentSection as $studentSection){
            $student_id[]=$studentSection->student_id;
        }
        $drop = Drop::all();
        $studentDrop_id = [];
        foreach($drop as $drop){
            $studentDrop_id[]=$drop->student_id;
        }
        $result = array_diff($student_id, $studentDrop_id);
        $result = array_values($result);
        $students = User::find($result);
        $fbIDs = [];
        foreach($students as $students){
            // $fbID = Facebook::where('student_id',$students->id)->first();
            $fbIDs[]=$students->id;
            
        }

        $fbID = Facebook::whereIn('student_id',$fbIDs)->get();
        $section = Section::find($section_id);
        $subject = Subject::find($subject_id);
        foreach($fbID as $fbID){
            $botman->say("Hello👋! Your instructor in section $section->section and subject $subject->subject give an announcement. Please click the Announcement in menu to view announcement.",$fbID->facebook_id, FacebookDriver::class);
        }
        // dd($fbID);
        return redirect()->to('instructor/announcement/view/'.$section_id.'/'.$subject_id)->with('success','Announcement Added!');
    }
    public function viewEditAnnouncement($id){
        $announcement = Announcement::find($id);
        return view('pages.instructor.announcement.edit-announcement',compact('announcement'));
    }
    public function viewUpdateAnnouncement(Request $request,$section_id,$subject_id,$id){
        $validateData = $request->validate([
            'deadline' => ['required'],
            'act_title' => ['required'],
            'instruction' => ['required'],
            'resources' => ['required'],
        ]);

        $announcement = Announcement::find($id);
        $announcement->deadline = Carbon::parse($request->deadline);
        $announcement->act_title = $request->act_title;
        $announcement->instruction = $request->instruction;
        $announcement->resources = $request->resources;
        $announcement->update();

        return redirect()->to('instructor/announcement/view/'.$section_id.'/'.$subject_id)->with('success','Announcement Updated!');
    }
    public function viewDeleteAnnouncement($section_id,$subject_id,$id){
        Announcement::find($id)->delete();
        return redirect()->to('instructor/announcement/view/'.$section_id.'/'.$subject_id)->with('success','Announcement Deleted!');
    }


}
