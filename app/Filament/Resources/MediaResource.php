<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaResource\Pages;
use App\Models\Media;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\Placeholder;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\ActionGroup;

class MediaResource extends Resource
{
    protected static ?string $model = Media::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Media & Sosial';

    protected static ?string $modelLabel = 'Media';

    protected static ?string $pluralModelLabel = 'Media';

    protected static ?string $navigationGroup = 'Konten Website';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Media')
                    ->description('Kelola konten media sosial dan dokumentasi')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul Media')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Contoh: Poster Umroh 2024'),

                                Forms\Components\Select::make('type')
                                    ->label('Tipe Media')
                                    ->required()
                                    ->options([
                                        'poster' => 'Poster/Banner',
                                        'tiktok' => 'TikTok Video',
                                        'instagram' => 'Instagram Post',
                                        'youtube' => 'YouTube Video',
                                        'facebook' => 'Facebook Post',
                                    ])
                                    ->native(false)
                                    ->live()
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        // Reset fields when type changes
                                        $set('url', null);
                                        $set('embed_id', null);
                                        $set('image_path', null);
                                    }),
                            ]),
                    ]),

                Section::make('Konten Media')
                    ->schema([
                        // Upload gambar untuk poster/banner
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Upload Gambar Poster')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                null,
                                '16:9',
                                '4:3',
                                '1:1',
                                '3:4',
                                '9:16'
                            ])
                            ->directory('media/posters')
                            ->visibility('public')
                            ->maxSize(5120) // 5MB max
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->helperText('Upload gambar poster (JPEG, PNG, WebP max 5MB)')
                            ->visible(fn (Forms\Get $get): bool => $get('type') === 'poster')
                            ->required(fn (Forms\Get $get): bool => $get('type') === 'poster'),

                        Forms\Components\TextInput::make('alt_text')
                            ->label('Alt Text')
                            ->placeholder('Deskripsi gambar untuk accessibility')
                            ->helperText('Deskripsi singkat untuk aksesibilitas')
                            ->visible(fn (Forms\Get $get): bool => $get('type') === 'poster'),

                        // TikTok embed ID
                        Forms\Components\TextInput::make('embed_id')
                            ->label('TikTok Video ID')
                            ->placeholder('7343716252787643680')
                            ->helperText('Masukkan ID video TikTok (angka di akhir URL)')
                            ->visible(fn (Forms\Get $get): bool => $get('type') === 'tiktok')
                            ->required(fn (Forms\Get $get): bool => $get('type') === 'tiktok'),

                        // Instagram post ID
                        Forms\Components\TextInput::make('embed_id')
                            ->label('Instagram Post ID')
                            ->placeholder('C1lJXt1P3gz')
                            ->helperText('Masukkan ID post Instagram (setelah /p/ di URL)')
                            ->visible(fn (Forms\Get $get): bool => $get('type') === 'instagram')
                            ->required(fn (Forms\Get $get): bool => $get('type') === 'instagram'),

                        // YouTube video ID
                        Forms\Components\TextInput::make('embed_id')
                            ->label('YouTube Video ID')
                            ->placeholder('dQw4w9WgXcQ')
                            ->helperText('Masukkan ID video YouTube (setelah v= di URL)')
                            ->visible(fn (Forms\Get $get): bool => $get('type') === 'youtube')
                            ->required(fn (Forms\Get $get): bool => $get('type') === 'youtube'),

                        // Facebook post URL
                        Forms\Components\TextInput::make('url')
                            ->label('Facebook Post URL')
                            ->url()
                            ->placeholder('https://www.facebook.com/yourpage/posts/123456789')
                            ->helperText('Masukkan URL lengkap post Facebook')
                            ->visible(fn (Forms\Get $get): bool => $get('type') === 'facebook')
                            ->required(fn (Forms\Get $get): bool => $get('type') === 'facebook'),
                    ]),

                Section::make('Pengaturan Tampilan')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Forms\Components\Toggle::make('is_active')
                                    ->label('Aktif')
                                    ->helperText('Tampilkan di website')
                                    ->default(true),

                                Forms\Components\TextInput::make('order')
                                    ->label('Urutan')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('Urutan tampil (kecil ke besar)'),

                                Forms\Components\Toggle::make('is_featured')
                                    ->label('Unggulan')
                                    ->helperText('Tampilkan di slider utama')
                                    ->default(false),
                            ]),
                    ]),

                // Preview section
                Section::make('Preview')
                    ->schema([
                        Placeholder::make('preview')
                            ->label('')
                            ->content(function (Forms\Get $get): string {
                                $type = $get('type');
                                $embedId = $get('embed_id');
                                $url = $get('url');
                                $imagePath = $get('image_path');

                                if (!$type) {
                                    return 'Pilih tipe media untuk melihat preview';
                                }

                                return match($type) {
                                    'tiktok' => $embedId ?
                                        "Preview TikTok: https://www.tiktok.com/embed/{$embedId}" :
                                        'Masukkan TikTok Video ID',
                                    'instagram' => $embedId ?
                                        "Preview Instagram: https://www.instagram.com/p/{$embedId}/embed" :
                                        'Masukkan Instagram Post ID',
                                    'youtube' => $embedId ?
                                        "Preview YouTube: https://www.youtube.com/embed/{$embedId}" :
                                        'Masukkan YouTube Video ID',
                                    'poster' => !empty($imagePath) ?
                                        'Gambar poster telah diupload ✓' :
                                        'Upload gambar poster',
                                    'facebook' => $url ?
                                        "Preview Facebook: {$url}" :
                                        'Masukkan Facebook Post URL',
                                    default => 'Tipe media tidak dikenali'
                                };
                            })
                    ])
                    ->visible(fn (Forms\Get $get): bool => !empty($get('type'))),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_preview')
                    ->label('Preview')
                    ->getStateUsing(function (Model $record): ?string {
                        if ($record->type === 'poster' && $record->image_path) {
                            return asset('storage/' . $record->image_path);
                        }
                        return null;
                    })
                    ->size(60)
                    ->defaultImageUrl(asset('images/placeholder.png')),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Medium),

                Tables\Columns\BadgeColumn::make('type')
                    ->label('Tipe')
                    ->colors([
                        'primary' => 'poster',
                        'success' => 'tiktok',
                        'warning' => 'instagram',
                        'danger' => 'youtube',
                        'info' => 'facebook',
                    ])
                    ->icons([
                        'heroicon-o-photo' => 'poster',
                        'heroicon-o-video-camera' => 'tiktok',
                        'heroicon-o-camera' => 'instagram',
                        'heroicon-o-play' => 'youtube',
                        'heroicon-o-share' => 'facebook',
                    ]),

                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                IconColumn::make('is_featured')
                    ->label('Unggulan')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray'),

                Tables\Columns\TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Tipe Media')
                    ->options([
                        'poster' => 'Poster/Banner',
                        'tiktok' => 'TikTok Video',
                        'instagram' => 'Instagram Post',
                        'youtube' => 'YouTube Video',
                        'facebook' => 'Facebook Post',
                    ]),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif')
                    ->placeholder('Semua')
                    ->trueLabel('Aktif')
                    ->falseLabel('Tidak Aktif'),

                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Status Unggulan')
                    ->placeholder('Semua')
                    ->trueLabel('Unggulan')
                    ->falseLabel('Biasa'),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('activate')
                        ->label('Aktifkan')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function ($records) {
                            $records->each->update(['is_active' => true]);
                        }),
                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Nonaktifkan')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(function ($records) {
                            $records->each->update(['is_active' => false]);
                        }),
                ]),
            ])
            ->defaultSort('order', 'asc')
            ->reorderable('order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedia::route('/'),
            'create' => Pages\CreateMedia::route('/create'),
            'edit' => Pages\EditMedia::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('is_active', true)->count();
    }
}
