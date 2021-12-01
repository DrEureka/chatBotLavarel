<?php

namespace App\Estrategia\Interactivo;

use BotMan\BotMan\Messages\Conversations\Conversation;

class NotFound extends Conversation implements Estrategias
{
    public function run()
    {
        $this->say('No se encontro esa respuesta.');
    }
}
