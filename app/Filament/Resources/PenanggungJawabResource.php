<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenanggungJawabResource\Pages;
use App\Filament\Resources\PenanggungJawabResource\RelationManagers;
use App\Models\PenanggungJawab;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenanggungJawabResource extends Resource
{
    protected static ?string $model = PenanggungJawab::class;
    protected static ?string $navigationLabel = 'Penanggung Jawab';
    public static ?string $modelLabel = 'Penanggung Jawab';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenanggungJawabs::route('/'),
            'create' => Pages\CreatePenanggungJawab::route('/create'),
            'edit' => Pages\EditPenanggungJawab::route('/{record}/edit'),
        ];
    }
}
