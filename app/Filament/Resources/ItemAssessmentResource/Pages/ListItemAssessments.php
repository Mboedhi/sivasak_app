<?php

namespace App\Filament\Resources\ItemAssessmentResource\Pages;

use App\Filament\Resources\ItemAssessmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItemAssessments extends ListRecords
{
    protected static string $resource = ItemAssessmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
