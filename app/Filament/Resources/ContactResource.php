<?php

// app/Filament/Resources/ContactResource.php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone';

    protected static ?string $navigationLabel = 'Contact Info';

    protected static ?string $modelLabel = 'Contact Information';

    protected static ?string $pluralModelLabel = 'Contact Information';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Kantor')
                    ->schema([
                        Forms\Components\Textarea::make('office_address')
                            ->label('Alamat Kantor')
                            ->required()
                            ->rows(3)
                            ->placeholder('Masukkan alamat lengkap kantor')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Kontak Telepon')
                    ->schema([
                        Forms\Components\TextInput::make('phone_1')
                            ->label('Telepon Utama')
                            ->required()
                            ->tel()
                            ->placeholder('+62 812 3456 7890'),

                        Forms\Components\TextInput::make('phone_2')
                            ->label('Telepon Kedua')
                            ->tel()
                            ->placeholder('+62 813 4567 8901'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Email')
                    ->schema([
                        Forms\Components\TextInput::make('email_1')
                            ->label('Email Utama')
                            ->required()
                            ->email()
                            ->placeholder('info@rahmahtravel.com'),

                        Forms\Components\TextInput::make('email_2')
                            ->label('Email Kedua')
                            ->email()
                            ->placeholder('cs@rahmahtravel.com'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Jam Operasional')
                    ->schema([
                        Forms\Components\TextInput::make('monday_friday_hours')
                            ->label('Senin - Jumat')
                            ->required()
                            ->placeholder('08:00 - 17:00'),

                        Forms\Components\TextInput::make('saturday_hours')
                            ->label('Sabtu')
                            ->required()
                            ->placeholder('08:00 - 15:00'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Media Sosial')
                    ->description('Masukkan URL lengkap untuk setiap platform media sosial')
                    ->schema([
                        Forms\Components\TextInput::make('facebook_url')
                            ->label('Facebook')
                            ->url()
                            ->placeholder('https://facebook.com/rahmahtravel')
                            ->prefix('https://')
                            ->suffixIcon('heroicon-m-globe-alt'),

                        Forms\Components\TextInput::make('whatsapp_url')
                            ->label('WhatsApp')
                            ->url()
                            ->placeholder('https://wa.me/6281234567890')
                            ->prefix('https://')
                            ->suffixIcon('heroicon-m-globe-alt')
                            ->helperText('Gunakan format: wa.me/nomor atau biarkan kosong untuk auto-generate dari telepon utama'),

                        Forms\Components\TextInput::make('instagram_url')
                            ->label('Instagram')
                            ->url()
                            ->placeholder('https://instagram.com/rahmahtravel')
                            ->prefix('https://')
                            ->suffixIcon('heroicon-m-globe-alt'),

                        Forms\Components\TextInput::make('youtube_url')
                            ->label('YouTube')
                            ->url()
                            ->placeholder('https://youtube.com/@rahmahtravel')
                            ->prefix('https://')
                            ->suffixIcon('heroicon-m-globe-alt'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true)
                            ->helperText('Hanya satu kontak yang boleh aktif pada satu waktu'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('office_address')
                    ->label('Alamat')
                    ->limit(50)
                    ->searchable()
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    }),

                Tables\Columns\TextColumn::make('phone_1')
                    ->label('Telepon Utama')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-m-phone'),

                Tables\Columns\TextColumn::make('email_1')
                    ->label('Email Utama')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-m-envelope'),

                Tables\Columns\IconColumn::make('facebook_url')
                    ->label('FB')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray'),

                Tables\Columns\IconColumn::make('whatsapp_url')
                    ->label('WA')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray'),

                Tables\Columns\IconColumn::make('instagram_url')
                    ->label('IG')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray'),

                Tables\Columns\IconColumn::make('youtube_url')
                    ->label('YT')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray'),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Status')
                    ->beforeStateUpdated(function ($record, $state) {
                        // Jika mengaktifkan, nonaktifkan yang lain
                        if ($state) {
                            Contact::where('id', '!=', $record->id)->update(['is_active' => false]);
                        }
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('Semua')
                    ->trueLabel('Aktif')
                    ->falseLabel('Tidak aktif'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('preview_social')
                    ->label('Preview Sosmed')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->modalHeading('Preview Social Media Links')
                    ->modalContent(function ($record) {
                        $links = $record->social_media_links;
                        $content = '<div class="space-y-3">';

                        foreach ($links as $platform => $url) {
                            $icon = match($platform) {
                                'facebook' => '📘',
                                'whatsapp' => '💬',
                                'instagram' => '📷',
                                'youtube' => '📺',
                                default => '🔗'
                            };

                            if ($url) {
                                $content .= "<div class='flex items-center space-x-2'>";
                                $content .= "<span>{$icon}</span>";
                                $content .= "<span class='font-medium capitalize'>{$platform}:</span>";
                                $content .= "<a href='{$url}' target='_blank' class='text-blue-600 hover:underline'>{$url}</a>";
                                $content .= "</div>";
                            }
                        }

                        $content .= '</div>';
                        return new \Illuminate\Support\HtmlString($content);
                    })
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
           
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        $activeCount = static::getModel()::active()->count();
        return $activeCount > 0 ? (string) $activeCount : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::active()->count() > 0 ? 'success' : 'warning';
    }
}
