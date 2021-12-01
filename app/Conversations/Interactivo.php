<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;

class Interactivo extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->askInteractivo();
    }

    private function askInteractivo()
    {
        $question = Question::create('Que deseas consultar?')
            ->fallback('No se entendio la pregunta')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('Nuevo producto')->value('0'),
                Button::create('Preguntas')->value('1'),
                Button::create('Ver videos')->value('2'),
                Button::create('Validar')->value('3'),
            ]);
        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $content = Interactivo::getStrategy($answer->getValue());
                $this->getBot()->startConversation(new $content());
            }
        });
    }
}
