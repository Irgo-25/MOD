<?php

namespace App\Filament\Resources\TemuanResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

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
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('temuan_id')
            ->columns([
                TextColumn::make('status'),
                ImageColumn::make('img_url')
                    ->label('Gambar Tindakan')
                    ->height(120),
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
}
