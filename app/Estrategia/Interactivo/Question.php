<?php

namespace App\Estrategias\Interactivo;

use App\InteractiveData;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;

class Question extends Conversation implements Estrategia
{
    public function run()
    {
        $this->askName(new InteractiveData());
    }
    //Captura nombre
    private function askName(InteractiveData $param)
    {
        $this->ask("Cual es tu nombre?", function (Answer $answer) use ($param) {
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
                $this->askTexto($param);
            }
        });
    }

    //Ingresa texto del problema y captura
    private function askTexto(InteractiveData $param)
    {
        $this->ask("Cual es el problema?", function (Answer $answer) use ($param) {
            $param->texto = $answer->getText();
            if (trim($param->texto) == '') {
                $this->askTexto($param);
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
        $this->say("Mucho gusto" . $param->name . ' ' . $param->lastname . ' Su EQ' . $param->address . ' y su correo de contacto es: ' . $param->email . 'Se mensaje fue enviado exitosamente a nuestro sistema de soporte');
    }
}
