<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('Jay-Are', function ($bot) {
    $bot->reply('Gwapo!');
});
$botman->hears('Start conversation', BotManController::class.'@startConversation');
