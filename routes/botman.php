<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('GET_STARTED', function ($bot) {
    $bot->typesAndWaits(1);
    $firstName = $bot->getUser()->getFirstName();
    $senderId = $bot->getUser()->getId();
    $input = json_decode(file_get_contents('php://input'), true);
    $senderId = $input['entry'][0]['messaging'][0]['sender']['id'];
    // $bot->reply("Hi $firstName 👋!\n\nI think this is your first time using this chatbot right?\n\nI am 🤖UPortal🤖 giving you free access to University Portal.\n\nNow, I will give your Facebook ID. Copy your ID and paste it in your student's portal.");
    $bot->reply('Facebook ID: '.$senderId);

    $bot->reply('👋Hello! This is UPortal, a hussle free access to university portal.');
});
$botman->hears('FB_PAYLOAD', function ($bot) {
    $bot->typesAndWaits(1);
    $firstName = $bot->getUser()->getFirstName();
    $senderId = $bot->getUser()->getId();
    
    // $bot->reply("Hi $firstName 👋!\n\nI think this is your first time using this chatbot right?\n\nI am 🤖UPortal🤖 giving you free access to University Portal.\n\nNow, I will give your Facebook ID. Copy your ID and paste it in your student's portal.");
    $bot->reply('Facebook ID: '.$senderId);

    $bot->reply('👋Hello! This is UPortal, a hussle free access to university portal.');
});
$botman->hears('Start conversation', BotManController::class.'@startConversation');
