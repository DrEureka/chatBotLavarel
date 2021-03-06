<?php

namespace App\Values;

use App\Estrategia\Operaciones\Subs;
use App\Estrategia\Operaciones\Add;
use App\Estrategia\Operaciones\Mult;
use App\Estrategia\Operaciones\NotFound;
use App\Estrategia\Operaciones\Divide;

final class Operador
{
    const GET_STRATEGY = [
        'S' => Add::class,
        'R' => Subs::class,
        'M' => Mult::class,
        'F' => Divide::class,
    ];

    static function getStrategy($value)
    {
        if (key_exists($value, self::GET_STRATEGY)) {
            return self::GET_STRATEGY[$value];
        }
        return NotFound::class;
    }
}
