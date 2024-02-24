<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum JabatanList: string implements HasLabel
{
    case Direktur = 'Direktur';
    case GeneralManager = 'General Manager';
    case AstManager = 'Ast.Manager';
    case SPV = 'SPV';


    public function getLabel(): ?string
    {

        return match ($this) {
            self::Direktur => 'Direktur',
            self::GeneralManager => 'General Manager',
            self::AstManager => 'Ast.Manager',
            self::SPV => 'SPV',
        };
    }
}
