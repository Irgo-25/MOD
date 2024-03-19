<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Pages\Page;

class LaporanTemuan extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.laporan-temuan';
}
