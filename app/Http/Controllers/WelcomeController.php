<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use App\Conversations\WelcomeConversation;
use App\Conversations\AvailableOptionConversation;

class WelcomeController extends Controller
{
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{anything}', function ( $bot ) {
            $this->startConversation( $bot );
        });
               
        $botman->listen();
    }

    public function startConversation( BotMan $bot )
    {
        $bot->startConversation( new WelcomeConversation() );
    }

   


}
