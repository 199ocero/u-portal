<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Drop;
use App\Models\User;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Irregular;
use Illuminate\Http\Request;
use App\Imports\StudentImport;
use App\Imports\SubjectImport;
use App\Models\StudentSection;
use Illuminate\Validation\Rule;
use App\Imports\InstructorImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class Administrator extends Controller
{
    public function viewInstructor(){
        $instructor = User::whereRoleIs('instructor')->get();
        return view('pages.admin.instructor.view-instructor',compact('instructor'));
    }
    public function viewAddPageInstuctor(){
        return view('pages.admin.instructor.create-instructor');
    }
    public function viewAddInstructor(Request $request){
        $id = Auth::user()->id;
        $instructor = User::find($id);

        $validateData = $request->validate([
            'first_name' => ['required', 'max:255'],
            'middle_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'username' => ['required','unique:users','max:255'],
            'email' => ['required','unique:users','max:255']
        ]);
        $password = Carbon::now()->format('m-d-Y');
        $instructor = new User();
        $instructor->username = $request->username;
        $instructor->first_name = $request->first_name;
        $instructor->middle_name = $request->middle_name;
        $instructor->last_name = $request->last_name;
        $instructor->email = $request->email;
        $instructor->password= Hash::make($password.'-'.$request->username);
        $instructor->save();
        $instructor->attachRole($request->role_id);
        return redirect()->route('view.administrator.instructor')->with('success','Instructor Added!');
    }
    public function viewEditInstructor($id){
        $instructor = User::find($id);
        return view('pages.admin.instructor.edit-instructor',compact('instructor'));
    }
    public function viewUpdateInstructor(Request $request, $id){
        $instructor = User::find($id);
        
        $validateData = $request->validate([
            'first_name' => ['required', 'max:255'],
            'middle_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'username' => [
                'required',
                Rule::unique('users')->ignore($instructor->id),
            ],
            'email' => [
                'required',
                Rule::unique('users')->ignore($instructor->id),
            ],
        ]);
        $instructor->username = $request->username;
        $instructor->first_name = $request->first_name;
        $instructor->middle_name = $request->middle_name;
        $instructor->last_name = $request->last_name;
        $instructor->email = $request->email;
        $instructor->update();

        return redirect()->route('view.administrator.instructor')->with('success','Instructor Updated!');
    }
    public function viewDeleteInstructor($id){
        $instructor = User::find($id)->delete();
        return redirect()->route('view.administrator.instructor')->with('success','Instructor Deleted!');
    }
    //Instructor Excel File
    public function uploadExcelInstructor(Request $request){
        $file = $request->file('file');

        Excel::import(new InstructorImport,$file);

        return redirect()->route('view.administrator.instructor')->with('success','Instructor Added!');
    }
    //Section
    public function viewSection(){
        $studentSection = StudentSection::select('section_id')->groupBy('section_id')->get();
        return view('pages.admin.section.view-section',compact('studentSection'));
    }

    public function viewAddSection(Request $request){
        $validateData = $request->validate([
            'section' => ['required','unique:sections', 'max:255'],
            'file' => ['required'],
        ]);
        $student = User::whereRoleIs('student')->get();
        $file = $request->file('file');
        $studentList = (new StudentImport)->toArray($file);
        Excel::import(new StudentImport,$file);
        
        $studentSectionList = StudentSection::all();

        if($studentSectionList->isEmpty()){
            $section = new Section();
            $section->section = $request->section;
            $section->save();

            $student = User::whereRoleIs('student')->get();
            for($y=0;$y<count($studentList[0]);$y++){
                $studentSection = new StudentSection();
                $studentSection->section_id=$section->id;
                for($i=0;$i<count($student);$i++){
                    if($student[$i]['username']==$studentList[0][$y]['username']){
                        $studentSection->student_id=$student[$i]['id'];
                    }
                }
                
                $studentSection->save();
            }
            return redirect()->route('view.administrator.section')->with('success','Section and Student Added!');

        }
        else{
            $studentUsername = array();
            $studentUsernameF = array();
            for($y=0;$y<count($studentList[0]);$y++){

                array_push($studentUsernameF, $studentList[0][$y]['username']);
                for($i=0;$i<count($student);$i++){
                    if($student[$i]['username']==$studentList[0][$y]['username']){
                        array_push($studentUsername, $studentList[0][$y]['username']);
                    }
                }
            }
            $unique = array_diff($studentUsernameF,$studentUsername);
            $uniqueUsername = array_values($unique);
            // dd($studentUsernameF);

            if($unique==NULL){
                return redirect()->route('view.administrator.section')->with('danger','All of student records are already registerd!');
            }elseif(count($uniqueUsername)<count($studentUsernameF)){

                // dd($uniqueUsername[0]);
                $section = new Section();
                $section->section = $request->section;
                $section->save();

                $student = User::whereRoleIs('student')->get();

                for($y=0;$y<count($uniqueUsername);$y++){
                    
                    $studentSection = new StudentSection();
                    $studentSection->section_id=$section->id;
                    
                    for($i=0;$i<count($student);$i++){
                        if($student[$i]['username']==$uniqueUsername[$y]){
                            $studentSection->student_id=$student[$i]['id'];
                        }
                    }
                    $studentSection->save();
                }
                return redirect()->route('view.administrator.section')->with('success','Some of student records are already registerd!');
            }
            else{
                $section = new Section();
                $section->section = $request->section;
                $section->save();

                $student = User::whereRoleIs('student')->get();

                for($y=0;$y<count($studentList[0]);$y++){
                    $studentSection = new StudentSection();
                    $studentSection->section_id=$section->id;

                    for($i=0;$i<count($student);$i++){
                        if($student[$i]['username']==$studentList[0][$y]['username']){
                            $studentSection->student_id=$student[$i]['id'];
                        }
                    }
                    
                    $studentSection->save();
                }
                return redirect()->route('view.administrator.section')->with('success','Section and student registered!');
            }
            
        }
    }
    public function viewEditSection($id){
        $section = Section::find($id);
        return view('pages.admin.section.edit-section',compact('section'));
    }

    public function viewUpdateSection(Request $request, $id){
        $section = Section::find($id);
        
        $validateData = $request->validate([
            'section' => [
                'required',
                Rule::unique('sections')->ignore($section->id),
            ],
        ]);
        $section->section = $request->section;
        $section->update();

        return redirect()->route('view.administrator.section')->with('success','Section Updated!');
    }
    public function viewDeleteSection($id){
        // $student = User::whereRoleIs('student')->get();
        $studentSection = StudentSection::orderBy('id','asc')->where('section_id', $id)->get();;

        foreach($studentSection as $studentSection){
            User::find($studentSection->student_id)->delete();
        }
        Section::find($id)->delete();
        StudentSection::where('section_id',$id)->delete();
        return redirect()->route('view.administrator.section')->with('success','Section Deleted!');
    }

    public function viewDetailSection($id){
        $assign = StudentSection::where('section_id',$id)->get();
        $section = Section::find($id);
        $drop = Drop::all();
        $irregular = Irregular::all();


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

        return view('pages.admin.section.details-section',compact('section','assign','status'));
    }

    public function viewAddPageStudentSection($id){
        $subjectID = $id;
        return view('pages.admin.section.create-student',compact('subjectID'));
    }
    public function viewAddStudentSection(Request $request, $id){
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
        $studentSection->section_id=$id;
        $studentSection->student_id=$student->id;
        $studentSection->save();

        return redirect()->route('view.details.section',$id)->with('success','Student Added!');
    }

    public function viewEditStudentSection($id){
        $student = User::find($id);
        // $studentSection = StudentSection::where('student_id',$id);
        $studentSection = StudentSection::where('student_id', $id)->first();
        
        // dd($studentSection->toArray());
        return view('pages.admin.section.edit-student',compact('student','studentSection'));
    }
    public function viewUpdateStudentSection(Request $request, $id){
        $student = User::find($id);
        
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

        return redirect()->route('view.details.section',$request->section_id)->with('success','Student Updated!');
    }   

    public function viewDeleteStudentSection($id){
        $studentSection = StudentSection::where('student_id',$id)->first();
        StudentSection::where('student_id',$id)->delete();
        User::find($id)->delete();
        $irreg = Irregular::find($id);
        if($irreg){
            Irregular::find($id)->delete();
            return redirect()->route('view.details.section',$studentSection->section_id)->with('success','Student Deleted!');

        }else{
            return redirect()->route('view.details.section',$studentSection->section_id)->with('success','Student Deleted!');
        }
    }
    //Subject
    public function viewSubject(){
        $subject = Subject::all();
        return view('pages.admin.subject.view-subject',compact('subject'));
    }
    public function viewAddPageSubject(){
        return view('pages.admin.subject.create-subject');
    }
    public function viewAddSubject(Request $request){

        $validateData = $request->validate([
            'subject' => ['required','unique:subjects', 'max:255'],
        ]);
        $subject = new Subject();
        $subject->subject = $request->subject;
        $subject->save();

        return redirect()->route('view.administrator.subject')->with('success','Subject Added!');
    }
    public function viewEditSubject($id){
        $subject = Subject::find($id);
        return view('pages.admin.subject.edit-subject',compact('subject'));
    }

    public function viewUpdateSubject(Request $request, $id){
        $subject = Subject::find($id);
        
        $validateData = $request->validate([
            'subject' => [
                'required',
                Rule::unique('subjects')->ignore($subject->id),
            ],
        ]);
        $subject->subject = $request->subject;
        $subject->update();

        return redirect()->route('view.administrator.subject')->with('success','Subject Updated!');
    }
    public function viewDeleteSubject($id){
        $subject = Subject::find($id)->delete();
        return redirect()->route('view.administrator.subject')->with('success','Subject Deleted!');
    }

    public function uploadExcelSubject(Request $request){
        $file = $request->file('file');

        Excel::import(new SubjectImport,$file);

        return redirect()->route('view.administrator.subject')->with('success','Subject Added!');
    }

}
