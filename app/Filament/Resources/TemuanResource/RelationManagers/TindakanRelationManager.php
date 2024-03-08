<?php

namespace App\Filament\Resources\TemuanResource\RelationManagers;

use Filament\Forms;
use Dotenv\Util\Str;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Departement;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Support\Facades\Date;

class TindakanRelationManager extends RelationManager
{
    protected static string $relationship = 'tindakans';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('status')
                    ->options([
                        'Proses' => 'Proses',
                        'Pending' => 'Pending',
                        'Dikerjakan' => 'Dikerjakan',
                        'Selesai' => 'Selesai'
                    ])
                    ->native(false)
                    ->required(),
                FileUpload::make('img_url')
                    ->multiple()
                    ->disk('public')
                    ->directory('Image_tindakan')
                    ->enableOpen(),
                    Select::make('pic')
                    ->label('PIC Wilayah')
                    ->searchable()
                    ->relationship('departement_pic', 'pic')
                    ->getSearchResultsUsing(fn (string $search): array => Departement::where('name', 'like', "%{$search}%")->limit(50)->pluck('pic', 'id')->toArray())
                    ->searchPrompt('Masukan Nama Departement')
                    ->required()
                    ->native(false),
                TextInput::make('tanggapan_pic')
                ->required()
                ->maxLength(255),
                TextInput::make('keterangan')
                ->required()
                ->maxLength(255),
                DatePicker::make('rencana_perbaikan')
                ->format('D-M-Y')
                ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('temuan_id')
            ->columns([
                TextColumn::make('status')
                ->badge()
                ->color(fn(string $state): string=> match ($state){
                    'Proses' => 'danger',
                    'Pending' => 'warning',
                    'Dikerjakan' => 'grey',
                    'Selesai' => 'success'
                }),
                ImageColumn::make('img_url')
                    ->label('Gambar Tindakan')
                    ->height(120),
                TextColumn::make('created_at')
                    ->label('Tanggal Pelaporan')
                    ->searchable()
                    ->date('D,d-M-Y'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
        // ->bulkActions([
        //     Tables\Actions\BulkActionGroup::make([
        //         Tables\Actions\DeleteBulkAction::make(),
        //     ]),
        // ]);
    }

    public function isReadOnly(): bool
    {
        return false;
    }
}
