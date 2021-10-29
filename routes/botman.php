<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('GET_STARTED', function ($bot) {
    $bot->reply('👋Hello! This is UPortal, a hussle free access to university portal.');
});
$botman->hears('Start conversation', BotManController::class.'@startConversation');
