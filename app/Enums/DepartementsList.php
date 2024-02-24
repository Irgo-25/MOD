<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum DepartementsList: string implements HasLabel
{
    case Accounting = 'Accounting';
    case DigitalMarketing = 'Digital Marketing';
    case Exim = 'Exim';
    case GA = 'GA';
    case HRD = 'HRD';
    case IT = 'IT';
    case Sekretaris = 'Sekretaris';

    public function getLabel(): ?string
    {

        return match ($this) {
            self::Accounting => 'Accounting',
            self::DigitalMarketing => 'Digital Marketing',
            self::Exim => 'Exim',
            self::GA => 'GA',
            self::HRD => 'HRD',
            self::IT => 'IT',
            self::Sekretaris => 'Sekretaris',
        };
    }
}
