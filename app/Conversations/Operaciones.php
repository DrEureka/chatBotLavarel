<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
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
                Button::create('Suma')->value('S'),
                Button::create('Resta')->value('R'),
                Button::create('Multiplicacion')->value('M'),
                Button::create('Multiplicacion')->value('D'),
            ]);
    }
}
