<?php

namespace App\Filament\Resources\PenanggungJawabResource\Pages;

use App\Filament\Resources\PenanggungJawabResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListPenanggungJawabs extends ListRecords
{
    protected static string $resource = PenanggungJawabResource::class;
    protected static ?string $title = 'Penanggung Jawab';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
