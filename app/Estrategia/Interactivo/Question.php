<?php

namespace App\Estrategia\Interactivo;

use App\InteractiveData;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use App\Conversations\Interactivo;

class Question extends Conversation implements Estrategias
{
// "use regresar o salir, busca el arhcivo php y hace la pregunta cuando es si vuelve a iniciar la conversacion.
use ReturnOrExit;
    public function run()
    {
        $this->askName(new InteractiveData());
    }
    //Captura nombre
    private function askName(InteractiveData $param)
    {
        $this->ask('Para registrar un incidente es necesario ingresar unos datos: ' .
            'Cual es tu nombre?', function (Answer $answer) use ($param) {
            $param->name = $answer->getText();
            if (trim($param->name) == '') {
                $this->askName($param);
            } else {
                $this->askLastName($param);
            }
        });
    }

    //Captura Apellido
    private function askLastName(InteractiveData $param)
    {
        $this->ask("Cual es tu Apellido?", function (Answer $answer) use ($param) {
            $param->lastname = $answer->getText();
            if (trim($param->lastname) == '') {
                $this->askLastName($param);
            } else {
                $this->askAddress($param);
            }
        });
    }
    //Captura EQ
    private function askAddress(InteractiveData $param)
    {
        $this->ask("Cual es tu EQ?", function (Answer $answer) use ($param) {
            $param->address = $answer->getText();
            if (trim($param->address) == '') {
                $this->askAddress($param);
            } else {
                $this->askEmail($param);
            }
        });
    }
    //Valida y captura mail
    private function askEmail(InteractiveData $param)
    {
        $this->ask("Cual es tu Email?", function (Answer $answer) use ($param) {
            $param->email = $answer->getText();
            if (!filter_var($param->email, FILTER_VALIDATE_EMAIL)) {
                $this->askEmail($param);
            } else {
                $this->askText($param);
            }
        });
    }

    //Ingresa texto del problema y captura
    private function askText(InteractiveData $param)
    {
        $this->ask("Cual es el problema?", function (Answer $answer) use ($param) {
            $param->text = $answer->getText();
            if (trim($param->text) == '') {
                $this->askText($param);
            } else {
                $this->finish($param);
            }
        });
    }

    private function finish(InteractiveData $param)
    {
        if (InteractiveData::query()->where('email', '=', $param->email)->count() == 0) {
            $param->save();
        }
        $this->say("Mucho gusto " . $param->name . ' ' . $param->lastname . ' Su EQ' . $param->address . ' y su correo de contacto es: ' . $param->email . ' Su mensaje fue enviado exitosamente a nuestro sistema de soporte');
        //llama al return y hace la consulta en la clase interactivo
        $this->returnOrExit(Interactivo::class);
    }
}
