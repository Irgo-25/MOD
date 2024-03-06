<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Faker\Core\Color;
use App\Models\Temuan;
use App\Models\Tindakan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Departement;
use App\Models\PenanggungJawab;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
// use Filament\Resources\RelationManagers\RelationManager;
// use App\Filament\Resources\TemuanResource\RelationManagers;
// use Filament\Forms\Components\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Infolists\Components\ImageEntry;
use App\Filament\Resources\TemuanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TemuanResource\Pages\ViewTemuan;
use App\Filament\Resources\TemuanResource\RelationManagers\TindakanRelationManager;

class TemuanResource extends Resource
{
    protected static ?string $model = Temuan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Temuan';
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
                    ->label('Gambar Temuan')
                    ->multiple()
                    ->disk('public')
                    ->directory('Image_temuan')
                    ->enableOpen(),
                TextInput::make('usulan')
                    ->required()
                    ->maxLength(255),
                TextInput::make('tanggapan_pj')
                    ->label('Tanggapan Penanggung Jawab')
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
                    ->label('Gambar Temuan')
                    ->circular()
                    ->stacked()
                    ->overlap(4),
                TextColumn::make('penanggung_jawab.name')
                    ->sortable(),
                TextColumn::make('usulan')
                    ->searchable(),
                TextColumn::make('tanggapan_pj')
                    ->label('Tanggapan Penanggung Jawab')
                    ->searchable(),
                TextColumn::make('departement.name')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Tanggal Pelaporan')
                    ->searchable()
                    ->date('D,d-M-Y'),
                TextColumn::make('jadwal_penyelesaian')
                    ->date('D,d-M-Y')
                    ->sortable(),
                TextColumn::make('rencana_perbaikan')
                    ->date('D,d-M-Y')
                    ->sortable(),
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
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Detail')
                    ->color('info'),
                Tables\Actions\EditAction::make()
                    ->label('Buat Tindakan'),
            ], position: ActionsPosition::BeforeColumns)

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                ImageEntry::make('img_url')
                    ->label('Gambar Temuan')
                    ->height(150),
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
            'view' => ViewTemuan::route('/{record}'),
            'edit' => Pages\EditTemuan::route('/{record}/edit'),
        ];
    }
}
