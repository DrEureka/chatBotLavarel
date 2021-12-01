<?php

namespace App\Estrategia\Interactivo;

use App\Conversations\Interactivo;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

class Img extends Conversation implements Estrategias
{
    // "use regresar o salir, busca el arhcivo php y hace la pregunta cuando es si vuelve a iniciar la conversacion.
    use ReturnOrExit;
    public function run()
    {
        $attachment = new Image('https://picsum.photos/200/300');
        $response = OutgoingMessage::create('Este es mi nuevo producto')
            ->withAttachment($attachment);
        $this->say($response);
        //Linea 21 llama al return y hace la consulta en la clase interactivo
        $this->returnOrExit(Interactivo::class);
    }
}
