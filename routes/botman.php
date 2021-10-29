<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('GET_STARTED', function ($bot) {
    $bot->typesAndWaits(1);
    $firstName = $bot->getUser()->getFirstName();
    $senderId = $bot->getUser()->getId();
    $bot->reply("Hi $firstName 👋!\n\nI think this is your first time using this chatbot right?\n\nI am 🤖UPortal🤖 giving you free access to University website.\n\nNow, I will give your Facebook ID and you just have to present it to the registrar.");
    $bot->reply('Facebook ID: '.$senderId);

    // $bot->reply('👋Hello! This is UPortal, a hussle free access to university portal.');
});
$botman->hears('Start conversation', BotManController::class.'@startConversation');
