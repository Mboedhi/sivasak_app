<?php

namespace App\Filament\Resources\ComplainResponseResource\Pages;

use App\Filament\Resources\ComplainResponseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditComplainResponse extends EditRecord
{
    protected static string $resource = ComplainResponseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
