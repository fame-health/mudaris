<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Models\Partner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage; // Added import for Storage facade

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationLabel = 'Mitra Bisnis';

    protected static ?string $pluralLabel = 'Mitra Bisnis';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Mitra')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Masukkan nama mitra, misalnya: Garuda Indonesia'),
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->required()
                    ->rows(4)
                    ->placeholder('Tulis deskripsi mitra, misalnya: Maskapai penerbangan nasional...')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('logo_gray')
                    ->label('Logo Grayscale')
                    ->required()
                    ->image()
                    ->directory('partners/logos/gray')
                    ->visibility('public')
                    ->maxSize(2048) // 2MB max
                    ->placeholder('Unggah logo grayscale (maks 2MB)')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('logo_color')
                    ->label('Logo Berwarna')
                    ->required()
                    ->image()
                    ->directory('partners/logos/color')
                    ->visibility('public')
                    ->maxSize(2048) // 2MB max
                    ->placeholder('Unggah logo berwarna (maks 2MB)')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->helperText('Centang untuk menampilkan mitra di situs web.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Mitra')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->tooltip(fn ($record): string => $record->description)
                    ->searchable(),
                Tables\Columns\ImageColumn::make('logo_gray')
                    ->label('Logo Grayscale')
                    ->width(100)
                    ->height(100)
                    ->getStateUsing(fn ($record) => $record->logo_gray ? Storage::url($record->logo_gray) : null),
                Tables\Columns\ImageColumn::make('logo_color')
                    ->label('Logo Berwarna')
                    ->width(100)
                    ->height(100)
                    ->getStateUsing(fn ($record) => $record->logo_color ? Storage::url($record->logo_color) : null),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif')
                    ->trueLabel('Aktif')
                    ->falseLabel('Tidak Aktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }
}
