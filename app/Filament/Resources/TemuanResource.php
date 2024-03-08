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

use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;

use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
// use Filament\Resources\RelationManagers\RelationManager;
// use App\Filament\Resources\TemuanResource\RelationManagers;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Infolists\Components\ImageEntry;
use App\Filament\Resources\TemuanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TemuanResource\Pages\ViewTemuan;
use App\Filament\Resources\TemuanResource\RelationManagers\TindakanRelationManager;
use App\Models\Team;

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
                Select::make('pelaksana_mod')
                    ->label('Pelaksana MOD')
                    ->relationship('team', 'pelaksana_mod')
                    ->required()
                    ->multiple()
                    ->native(false),
                MarkdownEditor::make('deskripsi_temuan')
                    ->columnSpanFull()
                    ->required(),
                Select::make('pic')
                    ->label('PIC Wilayah')
                    ->searchable()
                    ->relationship('departement_pic', 'pic')
                    ->getSearchResultsUsing(fn (string $search): array => Departement::where('name', 'like', "%{$search}%")->limit(50)->pluck('pic', 'id')->toArray())
                    ->searchPrompt('Masukan Nama Departement')
                    ->required()
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
                    ->label('Usulan Pelaksana MOD')
                    ->required()
                    ->maxLength(255),
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
