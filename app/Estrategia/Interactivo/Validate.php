<?php

namespace App\Estrategia\Interactivo;

use BotMan\BotMan\Messages\Conversations\Conversation;
use App\Conversations\Interactivo;

class Validate extends Conversation implements Estrategias
{
    // "use regresar o salir, busca el arhcivo php y hace la pregunta cuando es si vuelve a iniciar la conversacion.
    use ReturnOrExit;

    public function run()
    {
        $this->ask('Escribe lo que queres saber, Hora o Fecha?', [
            [
                'pattern' => 'hora|hh|h',
                'callback' => function () {
                    $this->say(date('H:i:s'));
                    //llama al return y hace la consulta en la clase interactivo
                    $this->returnOrExit(Interactivo::class);
                }
            ],
            [
                'pattern' => 'fecha|f|fe',
                'callback' => function () {
                    $this->say(date('d/m/Y'));
                    //llama al return y hace la consulta en la clase interactivo
                    $this->returnOrExit(Interactivo::class);
                }
            ],
        ]);
    }
}
