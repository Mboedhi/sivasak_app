<?php

namespace App\Filament\Resources\NegotiateResource\Pages;

use App\Filament\Resources\NegotiateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNegotiates extends ListRecords
{
    protected static string $resource = NegotiateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
