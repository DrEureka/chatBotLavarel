<?php

use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('Hi|hola', function ($bot) {
    $bot->reply($bot->getUser()->getId());
    $bot->reply('Hello!/ Hola como estas');
});
$botman->hears('conversar', BotManController::class . '@startConversation');
$botman->hears('matematicas', BotManController::class . '@startOperaciones');
$botman->hears('interactivo', BotManController::class . '@startInteractivo');
