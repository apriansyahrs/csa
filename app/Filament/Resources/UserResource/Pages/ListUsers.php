<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Imports\UserImport;
use EightyNine\ExcelImport\ExcelImportAction;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExcelImportAction::make()
                ->color("success")
                ->use(UserImport::class),
            Actions\CreateAction::make(),
        ];
    }
}
