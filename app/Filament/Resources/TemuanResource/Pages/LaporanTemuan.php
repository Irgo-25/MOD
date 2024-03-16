<?php

namespace App\Filament\Resources\TemuanResource\Pages;

use App\Filament\Resources\TemuanResource;
use Filament\Resources\Pages\Page;

class LaporanTemuan extends Page
{
    protected static string $resource = TemuanResource::class;

    protected static string $view = 'filament.resources.temuan-resource.pages.laporan-temuan';
}
