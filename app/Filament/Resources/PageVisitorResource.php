<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageVisitorResource\Pages;
use App\Models\PageVisitor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PageVisitorResource extends Resource
{
    protected static ?string $model = PageVisitor::class;
    protected static ?string $navigationIcon = 'heroicon-o-eye';
    protected static ?string $navigationLabel = 'Page Visitors';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('page_name')
                    ->required(),
                Forms\Components\TextInput::make('visit_count')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('page_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('visit_count')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('success'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Last Visit'),
            ])
            ->defaultSort('visit_count', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPageVisitors::route('/'),
            'create' => Pages\CreatePageVisitor::route('/create'),
            'edit' => Pages\EditPageVisitor::route('/{record}/edit'),
        ];
    }
}
