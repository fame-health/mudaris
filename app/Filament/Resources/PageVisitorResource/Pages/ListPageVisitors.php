<?php

namespace App\Filament\Resources\PageVisitorResource\Pages;

use App\Filament\Resources\PageVisitorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPageVisitors extends ListRecords
{
    protected static string $resource = PageVisitorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
