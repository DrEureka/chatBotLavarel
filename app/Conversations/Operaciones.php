<?php

namespace App\Conversations;

use App\Values\Operador;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;

class Operaciones extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->askOperaciones();
    }

    private function askOperaciones()
    {
        $question = Question::create('Que concepto deseas recordar?')
            ->fallback('No se pudo responder la pregunta')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('suma')->value('S'),
                Button::create('resta')->value('R'),
                Button::create('multiplicacion')->value('M'),
                Button::create('division')->value('D'),
            ]);
        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $content = Operador::getStrategy($answer->getValue());
                $this->say((new $content)->process());
            }
        });
    }
}
