<?php

namespace App\Conversations;

use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class WelcomeConversation extends Conversation
{
     /**
     * First question
     */
    public function askQuestion()
    {
        $question = Question::create("¿Cuál Smart TV deseas consultar?")
            ->fallback('Lo siento, no sé como responderte')
            ->callbackId('ask_about_option')
            ->addButtons([
                Button::create('LG')->value('lg'),
                Button::create('Vizio')->value('vizio')
            ]);

        return $this->ask($question, function ( Answer $answer ) {
            switch ($answer->getValue()) {
                case 'lg':
                    $this->bot->startConversation( new LgConversation() );
                break;
                case 'vizio':
                    $this->bot->startConversation( new VizioConversation() );
                break;
                default:
                    $this->askQuestion();
                break;
            }
        });
    }

    /**
     * Start the conversation
     */

     
    public function run()
    {
        $this->askQuestion();
    }
}
