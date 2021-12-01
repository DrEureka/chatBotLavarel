<?php

namespace App\Estrategia\Interactivo;

use BotMan\BotMan\Messages\Attachments\Video;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use App\Conversations\Interactivo;

class Mp4 extends Conversation implements Estrategias
{// "use regresar o salir, busca el arhcivo php y hace la pregunta cuando es si vuelve a iniciar la conversacion.
    use ReturnOrExit;
    public function run()
    {
        $attachment = new Video('https://irrinews.com/wp-content/uploads/2016/11/Lorem-Ipsum-video.mp4', ['custom_playload'=>true]);
        $response = OutgoingMessage::create('Este es mi nuevo video')
            ->withAttachment($attachment);
        $this->say($response);
        //llama al return y hace la consulta en la clase interactivo
        $this->returnOrExit(Interactivo::class);
    }
}
