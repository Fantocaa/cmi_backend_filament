<?php

namespace App\Filament\Resources\ImageHomeResource\Pages;

use App\Filament\Resources\ImageHomeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListImageHomes extends ListRecords
{
    protected static string $resource = ImageHomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
