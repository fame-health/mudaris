<?php

namespace App\Filament\Resources\PageVisitorResource\Pages;

use App\Filament\Resources\PageVisitorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPageVisitor extends EditRecord
{
    protected static string $resource = PageVisitorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
