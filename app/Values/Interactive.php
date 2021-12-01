<?php

namespace App\Values;

use App\Estrategias\Interactivo\Mp4;
use App\Estrategias\Interactivo\Question;
use App\Estrategias\Interactivo\Validate;
use App\Estrategias\Interactivo\Img;
use App\Estrategias\Interactivo\NotFound;

final class Interactive
{
    const GET_STRATEGY = [
        '0' => Img::class,
        '1' => Question::class,
        '2' => Mp4::class,
        '3' => Validate::class,

    ];

    static function getStrategy($value)
    {
        if (key_exists($value, self::GET_STRATEGY)) {
            return self::GET_STRATEGY[$value];
        }
        return NotFound::class;
    }
}
