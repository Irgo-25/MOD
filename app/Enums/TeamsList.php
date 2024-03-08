<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum TeamsList: string implements HasLabel
{
    case A = 'A';
    case B = 'B';
    case C = 'C';
    case D = 'D';
    case E = 'E';
    case F = 'F';


    public function getLabel(): ?string
    {

        return match ($this) {
            self::A => 'A',
            self::B => 'B',
            self::C => 'C',
            self::D => 'D',
            self::E => 'E',
            self::F => 'F',
        };
    }
}
