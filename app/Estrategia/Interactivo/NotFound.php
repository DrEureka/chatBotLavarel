<?php

namespace App\Estrategias\Interactivo;

use BotMan\BotMan\Messages\Conversations\Conversation;

class NotFound extends Conversation implements Estrategia
{
    public function run()
    {
        $this->say('No se encontro esa respuesta.');
    }
}
