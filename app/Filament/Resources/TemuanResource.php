<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Temuan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MarkdownEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TemuanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TemuanResource\RelationManagers;
use App\Models\Departement;
use Filament\Forms\Components\Select;

class TemuanResource extends Resource
{
    protected static ?string $model = Temuan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                MarkdownEditor::make('deskripsi_temuan')
                    ->required(),
                Select::make('pj_id')
                    ->required(),
                Select::make('departement_id')
                    ->label('Departement')
                    ->options(Departement::all()->pluck('name', 'id'))
                    ->required()
                    ->native(false),
                TextInput::make('tindakan_status_id')
                    ->required(),
                TextInput::make('tindakan_img_url_id')
                    ->required(),
                TextInput::make('lokasi')
                    ->required()
                    ->maxLength(255),
                TextInput::make('img_url')
                    ->required()
                    ->maxLength(255),
                TextInput::make('usulan')
                    ->required()
                    ->maxLength(255),
                TextInput::make('tanggapan_pj')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('jadwal_penyelesaian')
                    ->required(),
                DatePicker::make('rencana_perbaikan')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('deskripsi_temuan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lokasi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('img_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pj_id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('usulan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggapan_pj')
                    ->searchable(),
                Tables\Columns\TextColumn::make('departement_id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jadwal_penyelesaian')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('rencana_perbaikan')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tindakan_status_id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tindakan_img_url_id')
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
            'index' => Pages\ListTemuans::route('/'),
            'create' => Pages\CreateTemuan::route('/create'),
            'edit' => Pages\EditTemuan::route('/{record}/edit'),
        ];
    }
}
