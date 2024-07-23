<?php

namespace App\Filament\Resources\ItemUnitTypeResource\Pages;

use App\Filament\Resources\ItemUnitTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageItemUnitTypes extends ManageRecords
{
    protected static string $resource = ItemUnitTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
