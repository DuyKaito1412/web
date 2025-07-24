<?php

namespace App\Filament\User\Resources\ProfileResource\Pages;

use App\Filament\User\Resources\ProfileResource;
use Filament\Resources\Pages\EditRecord;

class EditProfile extends EditRecord
{
    protected static string $resource = ProfileResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getUrl(['record' => $this->getRecord()]);
    }
}
