<?php
use App\Models\Drop;
use App\Models\User;
use App\Models\Facebook;
use App\Models\Irregular;
use App\Models\Announcement;
use App\Models\StudentSection;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('GET_STARTED', function ($bot) {
    $firstName = $bot->getUser()->getFirstName();
    $senderId = $bot->getUser()->getId();
    $bot->reply("Hi $firstName 👋!\n\nIs this your first time interacting with this chatbot?\n\nI'm UPortal🤖, and I'm here to provide you with free access to University Portal.\n\nNow, this is your Facebook ID. Copy your ID and paste it in your students portal.");
    $bot->reply('✅Facebook ID: '.$senderId);
});
$botman->hears('FB_PAYLOAD', function ($bot) {
    $firstName = $bot->getUser()->getFirstName();
    $senderId = $bot->getUser()->getId();
   
    $bot->reply("Hi $firstName 👋!\n\nIf you haven't yet entered your Facebook ID, simply copy it and paste it into your students portal. Simply go to the website by clicking the visit button.");
    $bot->reply('✅Facebook ID: '.$senderId);
});

$botman->hears('PERSONAL_PAYLOAD', function ($bot) {
    $senderId = $bot->getUser()->getId();
    $facebookID = Facebook::where('facebook_id',$senderId)->first();
    $student = User::find($facebookID->student_id);
    $bot->reply("📝 Student Information 📝\n\n▶️First Name: $student->first_name\n▶️Middle Name: $student->middle_name\n▶️Last Name: $student->middle_name\n📧Email: $student->email");
});

$botman->hears('ANNOUNCEMENT_PAYLOAD', function ($bot) {
    $senderId = $bot->getUser()->getId();
    $facebookID = Facebook::where('facebook_id',$senderId)->first();
    $drop = Drop::where('student_id',$facebookID->student_id)->get();
    $student = StudentSection::where('student_id',$facebookID->student_id)->get()->toArray();
    $irregular = Irregular::where('student_id',$facebookID->student_id)->get()->toArray();
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
    $anns = "";
    foreach($announcement as $announcement){
        $date = $announcement->deadline->format('F j, Y');
        $time = $announcement->deadline->format('h:i A');
        $section = $announcement['section']['section'];
        $subject = $announcement['subject']['subject'];
        $anns = "✅Section: $section\n✅Subject: $subject\n✅Date: $date\n✅Time: $time\n✅Activity Title: $announcement->act_title\n\n".$anns;
    }
    $bot->reply("📝 Announcement Information 📝\n\n$anns");
});



$botman->hears('Start conversation', BotManController::class.'@startConversation');
