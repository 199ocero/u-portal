<?php
use App\Models\User;
use App\Models\Facebook;
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('GET_STARTED', function ($bot) {
    $firstName = $bot->getUser()->getFirstName();
    $senderId = $bot->getUser()->getId();
    $bot->reply("Hi $firstName 👋!\n\nI think this is your first time using this chatbot right?\n\nI am 🤖UPortal🤖 giving you free access to University Portal.\n\nNow, this is give your Facebook ID. Copy your ID and paste it in your student's portal.");
    $bot->reply('✅Facebook ID: '.$senderId);
});
$botman->hears('FB_PAYLOAD', function ($bot) {
    $firstName = $bot->getUser()->getFirstName();
    $senderId = $bot->getUser()->getId();
   
    $bot->reply("Hi $firstName 👋!\n\n. If you not put yet your Facebook ID, just copy down below and paste it in your students portal. Just click the visit website.");
    $bot->reply('✅Facebook ID: '.$senderId);
});

$botman->hears('PERSONAL_PAYLOAD', function ($bot) {
    $senderId = $bot->getUser()->getId();
    $facebookID = Facebook::where('facebook_id',$senderId)->first();
    $student = User::find($facebookID->student_id);
    $bot->reply("First Name: $student->first_name\nMiddle Name: $student->middle_name");
});


$botman->hears('Start conversation', BotManController::class.'@startConversation');
