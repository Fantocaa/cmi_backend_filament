<?php

namespace App\Filament\Resources\ImageHomeResource\Pages;

use App\Filament\Resources\ImageHomeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditImageHome extends EditRecord
{
    protected static string $resource = ImageHomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
