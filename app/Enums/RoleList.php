<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum JabatanList: string implements HasLabel
{
    case Direktur = 'Direktur';
    case User = 'User';
    case Superuser = 'Superuser';


    public function getLabel(): ?string
    {

        return match ($this) {
            self::Direktur => 'Direktur',
            self::User => 'User',
            self::Superuser => 'Superuser',
        };
    }
}
