<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Temuan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Departement;
use App\Models\PenanggungJawab;
use Filament\Resources\Resource;

use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TemuanResource\Pages;
use Filament\Forms\Components\Actions\Action;
// use Filament\Resources\RelationManagers\RelationManager;
// use App\Filament\Resources\TemuanResource\RelationManagers;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TemuanResource\RelationManagers\TindakanRelationManager;
use Filament\Forms\Components\MarkdownEditor;

class TemuanResource extends Resource
{
    protected static ?string $model = Temuan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('tim')
                    ->required()
                    ->options([
                        'A' => 'A',
                        'B' => 'B',
                        'C' => 'C',
                        'D' => 'D',
                        'E' => 'E',
                        'F' => 'F',
                    ])
                    ->native(false),
                MarkdownEditor::make('deskripsi_temuan')
                    ->columnSpanFull()
                    ->required(),
                Select::make('pj_id')
                    ->label('Penanggung Jawab')
                    ->relationship('penanggung_jawab', 'name')
                    ->required()
                    ->createOptionAction(
                        fn (Action $action) => $action->modalWidth('lg'),
                    )
                    ->createOptionForm(
                        [
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                        ]
                    )
                    ->native(false),
                Select::make('departement_id')
                    ->label('Departement')
                    ->relationship('departement', 'name')
                    ->required()
                    ->createOptionAction(
                        fn (Action $action) => $action->modalWidth('lg'),
                    )
                    ->createOptionForm(
                        [
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                        ]
                    )
                    ->native(false),
                TextInput::make('lokasi')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('img_url')
                    ->multiple()
                    ->disk('public')
                    ->directory('Image_temuan')
                    ->enableOpen(),
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
                TextColumn::make('tim')
                    ->searchable(),
                TextColumn::make('deskripsi_temuan')
                    ->searchable(),
                TextColumn::make('lokasi')
                    ->searchable(),
                ImageColumn::make('img_url')
                    ->height(120),
                TextColumn::make('penanggung_jawab.name')
                    ->sortable(),
                TextColumn::make('usulan')
                    ->searchable(),
                TextColumn::make('tanggapan_pj')
                    ->searchable(),
                TextColumn::make('departement.name')
                    ->sortable(),
                TextColumn::make('jadwal_penyelesaian')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('rencana_perbaikan')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('tindakans.status')
                    ->sortable(),
                ImageColumn::make('tindakan.img_url')
                    ->label('Image Tindakan')
                    ->stacked(),
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
            TindakanRelationManager::class,
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
