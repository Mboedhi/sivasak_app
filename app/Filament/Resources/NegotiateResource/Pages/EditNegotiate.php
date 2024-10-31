<?php

namespace App\Filament\Resources\NegotiateResource\Pages;

use App\Filament\Resources\NegotiateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNegotiate extends EditRecord
{
    protected static string $resource = NegotiateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
