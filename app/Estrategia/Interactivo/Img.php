<?php

namespace App\Estrategia\Interactivo;

use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

class Img extends Conversation implements Estrategias
{
    public function run()
    {
        $attachment = new Image('https://picsum.photos/200/300');
        $response = OutgoingMessage::create('Este es mi nuevo producto')
            ->withAttachment($attachment);
        $this->say($response);
    }
}
