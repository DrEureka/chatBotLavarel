<?php

namespace App\Estrategia\Interactivo;

use BotMan\BotMan\Messages\Conversations\Conversation;

class Validate extends Conversation implements Estrategias
{
    

    public function run()
    {
        $this->ask('Escribe lo que queres saber, Hora o Fecha?', [
            [
                'pattern' => 'hora|hh|h',
                'callback' => function () {
                    $this->say(date('H:i:s'));
                }
            ],
            [
                'pattern' => 'fecha|f|fe',
                'callback' => function () {
                    $this->say(date('d/m/Y'));
                }
            ],
        ]);
    }
}
