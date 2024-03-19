<?php

namespace App\Livewire;

use App\Models\Temuan;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;


class ListLaporanTemuan extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    public function table(Table $table): Table
    {
        return $table
            ->query(Temuan::query())
            ->columns([
                TextColumn::make('team.tim')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('deskripsi_temuan')
                    ->searchable(),
                TextColumn::make('lokasi')
                    ->searchable(),
                ImageColumn::make('img_url')
                    ->label('Gambar Temuan')
                    ->circular()
                    ->stacked()
                    ->overlap(4),
                TextColumn::make('departement_pic.pic')
                    ->label('PIC Terkait')
                    ->sortable(),
                TextColumn::make('team.pelaksana_mod')
                    ->label('Pelaksana MOD')
                    ->sortable(),
                TextColumn::make('usulan')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Tanggal Temuan')
                    ->searchable()
                    ->date('D,d-M-Y'),
                TextColumn::make('tindakans.status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Proses' => 'danger',
                        'Pending' => 'warning',
                        'Dikerjakan' => 'info',
                        'Selesai' => 'success'
                    })
                    ->sortable(),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }
    public function render()
    {
        return view('livewire.list-laporan-temuan');
    }
}
