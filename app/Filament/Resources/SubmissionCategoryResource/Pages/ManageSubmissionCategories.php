<?php

namespace App\Filament\Resources\SubmissionCategoryResource\Pages;

use App\Filament\Resources\SubmissionCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSubmissionCategories extends ManageRecords
{
    protected static string $resource = SubmissionCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
