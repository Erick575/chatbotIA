<?php
use App\Http\Controllers\BotManController;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

$botman = resolve('botman');

$botman->fallback(function ($bot) {
    $bot->reply("Lo siento, no tengo respuesta a lo que me preguntas.");
});
