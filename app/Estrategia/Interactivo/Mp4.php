<?php

namespace App\Estrategia\Interactivo;

use BotMan\BotMan\Messages\Attachments\Video;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

class Mp4 extends Conversation implements Estrategias
{
    public function run()
    {
        $attachment = new Video('https://irrinews.com/wp-content/uploads/2016/11/Lorem-Ipsum-video.mp4', ['custom_playload'=>true]);
        $response = OutgoingMessage::create('Este es mi nuevo video')
            ->withAttachment($attachment);
        $this->say($response);
    }
}
