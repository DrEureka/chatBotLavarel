<?php

namespace App\Estrategia\Operaciones;

class NotFound implements Estrategias
{

    public function process()
    {
        return 'Operacion no encontrada';
    }
}
