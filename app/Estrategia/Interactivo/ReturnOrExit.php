<?php

namespace App\Estrategia\Interactivo;

trait ReturnOrExit
{
    private function returnOrExit($conversation)
    {
        $this->ask('Deseas continuar: Si o No', [
            [
                'pattern' => 'si|S|Si',
                'callback' => function () use ($conversation) {
                    $this->getBot()->startConversation(new $conversation());
                }
            ],
            [
                'pattern' => 'no|n|No',
                'callback' => function () {
                    $this->say('Que tengas un buen día, gracias por utilizar nuestros servicios');
                }
            ],
        ]);
    }
}
