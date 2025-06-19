<?php

namespace App\Filament\Resources;

use App\Models\Paket;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PaketResource extends Resource
{
    protected static ?string $model = Paket::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    protected static ?string $modelLabel = 'Travel Package';

    protected static ?string $navigationGroup = 'Konten Website';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Package Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                if ($operation === 'edit') {
                                    return;
                                }
                                $set('slug', Str::slug($state));
                            }),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('Rp'),
                        Forms\Components\Select::make('category')
                            ->options([
                                'regular' => 'Regular',
                                'vip' => 'VIP',
                                'family' => 'Family',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('duration_days')
                            ->numeric()
                            ->label('Duration (days)')
                            ->required(),
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Package Image')
                            ->image()
                            ->directory('package-images')
                            ->preserveFilenames()
                            ->imageEditor(),
                    ])->columns(2),

                Forms\Components\Section::make('Package Details')
                    ->schema([
                        Forms\Components\Repeater::make('features')
                            ->schema([
                                Forms\Components\TextInput::make('feature')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->columnSpanFull()
                            ->defaultItems(3),
                        Forms\Components\Textarea::make('departure_schedule')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('hotel_rating')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(5),
                        Forms\Components\Textarea::make('meals_description'),
                    ])->columns(2),



                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Featured Package'),
                        Forms\Components\Select::make('status')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                            ])
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Image')
                    ->disk('public')
                    ->size(50),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'vip' => 'danger',
                        'family' => 'success',
                        default => 'warning',
                    }),
                Tables\Columns\TextColumn::make('formatted_price')
                    ->label('Price')
                    ->sortable(),
                Tables\Columns\TextColumn::make('duration_days')
                    ->label('Duration')
                    ->suffix(' days')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Featured'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'regular' => 'Regular',
                        'vip' => 'VIP',
                        'family' => 'Family',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ]),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Featured Packages'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            // You can add relations here if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\PaketResource\Pages\ListPakets::route('/'),
            'create' => \App\Filament\Resources\PaketResource\Pages\CreatePaket::route('/create'),
            'edit' => \App\Filament\Resources\PaketResource\Pages\EditPaket::route('/{record}/edit'),
        ];
    }
}
