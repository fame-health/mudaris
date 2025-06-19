<?php

// app/Filament/Resources/ContactFormResource.php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactFormResource\Pages;
use App\Models\ContactForm;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ContactFormResource extends Resource
{
    protected static ?string $model = ContactForm::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';

    protected static ?string $navigationLabel = 'Contact Forms';

    protected static ?string $modelLabel = 'Contact Form';

    protected static ?string $pluralModelLabel = 'Contact Forms';

    protected static ?string $navigationGroup ='Masukan dari Pengguna';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Kontak')
                    ->schema([
                        Forms\Components\TextInput::make('full_name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->required()
                            ->email()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('phone')
                            ->label('No. Telepon')
                            ->required()
                            ->tel()
                            ->maxLength(255),

                        Forms\Components\Select::make('package_interest')
                            ->label('Paket yang Diminati')
                            ->required()
                            ->options(ContactForm::getPackageOptions()),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Pesan')
                    ->schema([
                        Forms\Components\Textarea::make('message')
                            ->label('Pesan')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Status & Follow Up')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->required()
                            ->options(ContactForm::getStatusOptions())
                            ->default(ContactForm::STATUS_NEW),

                        Forms\Components\DateTimePicker::make('responded_at')
                            ->label('Tanggal Respon')
                            ->nullable(),

                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Catatan Admin')
                            ->rows(3)
                            ->columnSpanFull()
                            ->placeholder('Tambahkan catatan internal untuk follow up...'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-m-envelope')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Telepon')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-m-phone')
                    ->formatStateUsing(fn ($state, $record) => $record->formatted_phone),

                Tables\Columns\TextColumn::make('package_interest')
                    ->label('Paket')
                    ->searchable()
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('message')
                    ->label('Pesan')
                    ->limit(50)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    })
                    ->toggleable(),

                Tables\Columns\SelectColumn::make('status')
                    ->label('Status')
                    ->options(ContactForm::getStatusOptions())
                    ->sortable()
                    ->selectablePlaceholder(false)
                    ->afterStateUpdated(function ($record, $state) {
                        if ($state === ContactForm::STATUS_IN_PROGRESS && !$record->responded_at) {
                            $record->update(['responded_at' => now()]);
                        }
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Diterima')
                    ->dateTime()
                    ->sortable()
                    ->since()
                    ->tooltip(fn ($state) => $state->format('d M Y H:i')),

                Tables\Columns\TextColumn::make('responded_at')
                    ->label('Direspon')
                    ->dateTime()
                    ->sortable()
                    ->since()
                    ->placeholder('Belum direspon')
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options(ContactForm::getStatusOptions())
                    ->placeholder('Semua Status'),

                Tables\Filters\SelectFilter::make('package_interest')
                    ->label('Paket')
                    ->options(ContactForm::getPackageOptions())
                    ->placeholder('Semua Paket'),

                Tables\Filters\Filter::make('responded')
                    ->label('Status Respon')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('responded_at'))
                    ->toggle(),

                Tables\Filters\Filter::make('today')
                    ->label('Hari Ini')
                    ->query(fn (Builder $query): Builder => $query->today())
                    ->toggle(),

                Tables\Filters\Filter::make('this_week')
                    ->label('Minggu Ini')
                    ->query(fn (Builder $query): Builder => $query->thisWeek())
                    ->toggle(),
            ])
            ->actions([
                Tables\Actions\Action::make('whatsapp')
                    ->label('WhatsApp')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('success')
                    ->url(fn ($record) => $record->whatsapp_link)
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => !empty($record->phone)),

                Tables\Actions\Action::make('mark_responded')
                    ->label('Tandai Direspon')
                    ->icon('heroicon-o-check-circle')
                    ->color('info')
                    ->action(fn ($record) => $record->markAsResponded())
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status === ContactForm::STATUS_NEW),

                Tables\Actions\Action::make('mark_completed')
                    ->label('Tandai Selesai')
                    ->icon('heroicon-o-check-badge')
                    ->color('success')
                    ->form([
                        Forms\Components\Textarea::make('notes')
                            ->label('Catatan Penyelesaian')
                            ->placeholder('Tambahkan catatan tentang penyelesaian ini...')
                            ->rows(3)
                    ])
                    ->action(function ($record, array $data) {
                        $record->markAsCompleted($data['notes'] ?? null);
                    })
                    ->visible(fn ($record) => in_array($record->status, [ContactForm::STATUS_NEW, ContactForm::STATUS_IN_PROGRESS])),

                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('mark_in_progress')
                        ->label('Tandai Sedang Diproses')
                        ->icon('heroicon-o-clock')
                        ->color('info')
                        ->action(function ($records) {
                            $records->each(function ($record) {
                                $record->update([
                                    'status' => ContactForm::STATUS_IN_PROGRESS,
                                    'responded_at' => $record->responded_at ?: now()
                                ]);
                            });
                        })
                        ->requiresConfirmation(),

                    Tables\Actions\BulkAction::make('mark_completed')
                        ->label('Tandai Selesai')
                        ->icon('heroicon-o-check-badge')
                        ->color('success')
                        ->action(fn ($records) => $records->each->markAsCompleted())
                        ->requiresConfirmation(),

                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Informasi Kontak')
                    ->schema([
                        Infolists\Components\TextEntry::make('full_name')
                            ->label('Nama Lengkap'),
                        Infolists\Components\TextEntry::make('email')
                            ->label('Email')
                            ->copyable(),
                        Infolists\Components\TextEntry::make('phone')
                            ->label('Telepon')
                            ->formatStateUsing(fn ($state, $record) => $record->formatted_phone)
                            ->copyable(),
                        Infolists\Components\TextEntry::make('package_interest')
                            ->label('Paket yang Diminati')
                            ->badge()
                            ->color('info'),
                    ])
                    ->columns(2),

                Infolists\Components\Section::make('Pesan')
                    ->schema([
                        Infolists\Components\TextEntry::make('message')
                            ->label('Pesan')
                            ->prose(),
                    ]),

                Infolists\Components\Section::make('Status & Timeline')
                    ->schema([
                        Infolists\Components\TextEntry::make('status')
                            ->label('Status')
                            ->formatStateUsing(fn ($record) => $record->status_label)
                            ->badge()
                            ->color(fn ($record) => $record->status_color),
                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Diterima')
                            ->dateTime(),
                        Infolists\Components\TextEntry::make('responded_at')
                            ->label('Direspon')
                            ->dateTime()
                            ->placeholder('Belum direspon'),
                        Infolists\Components\TextEntry::make('admin_notes')
                            ->label('Catatan Admin')
                            ->prose()
                            ->placeholder('Tidak ada catatan'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactForms::route('/'),
            'create' => Pages\CreateContactForm::route('/create'),

            'edit' => Pages\EditContactForm::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::new()->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        $newCount = static::getModel()::new()->count();
        return $newCount > 0 ? 'warning' : null;
    }
}
