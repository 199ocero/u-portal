<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Drop;
use App\Models\InstructorSectionSubject;
use App\Models\Irregular;
use App\Models\StudentSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Student extends Controller
{
    public function viewAnnouncement(){
        $drop = Drop::where('student_id',Auth::id())->get();
        $student = StudentSection::where('student_id',Auth::id())->get()->toArray();
        $irregular = Irregular::where('student_id',Auth::id())->get()->toArray();
        $status = array();
        $announce = Announcement::all();
        $announces = $announce->toArray();
        $announcement= collect();
        
        if(count($drop)!=0){
            for($i=0;$i<count($announces);$i++){
                for($y=0;$y<count(array($drop));$y++){
                    if($announce[$i]['section_id']!=$drop[$y]['section_id']&&$announce[$i]['subject_id']!=$drop[$y]['subject_id']){
                        $announcement->push($announce[$i]);
                    }
                }
            }
            for($i=0;$i<count($announcement);$i++){
                for($y=0;$y<count($irregular);$y++){
                    if($irregular[$y]['section_id']==$announcement[0]['section_id'] && $irregular[$y]['subject_id']==$announcement[0]['subject_id']){
                        array_push($status,'Irregular');
                        break;
                    }else{
                        array_push($status,'Regular');
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
                            array_push($status,'Irregular');
                            break;
                        }else{
                            array_push($status,'Regular');
                            break;
                        }
                    }
                }
            }
        }
        
        // for($i=0;$i<count($announcement);$i++){
        //     for($y=0;$y<count($irregular);$y++){
        //         if($irregular[$y]['section_id']==$announcement[0]['section_id'] && $irregular[$y]['subject_id']==$announcement[0]['subject_id']){
        //             array_push($status,'Irregular');
        //             break;
        //         }else{
        //             array_push($status,'Regular');
        //             break;
        //         }
        //     }
        // }
        // dd($announcement);
        // for($i=0;$i<count($student);$i++){
        //     $announce = Announcement::where('section_id',$student[$i]['section_id'])->get();

        //     for($x=0;$x<count($announce);$x++){

        //         $announcement->push($announce[$x]);
        //         $announces = Announcement::where('section_id',$student[$i]['section_id'])->get()->toArray();



        //         for($y=0;$y<count($irregular);$y++){
        //             if($irregular[$y]['section_id']==$announces[0]['section_id'] && $irregular[$y]['subject_id']==$announces[0]['subject_id']){
        //                 array_push($status,'Irregular');
        //                 break;
        //             }else{
        //                 array_push($status,'Regular');
        //                 break;
        //             }
        //         }
        //     }
        // }
        // dd($announcement);
        return view('pages.student.view-announcement',compact('announcement','status'));
    }
    public function viewAnnouncementDetails($id){
        $announcement = Announcement::find($id);
        return view('pages.student.details-announcement',compact('announcement'));
    }
}
