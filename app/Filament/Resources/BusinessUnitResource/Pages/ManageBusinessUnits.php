<?php

namespace App\Filament\Resources\BusinessUnitResource\Pages;

use App\Filament\Resources\BusinessUnitResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageBusinessUnits extends ManageRecords
{
    protected static string $resource = BusinessUnitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
