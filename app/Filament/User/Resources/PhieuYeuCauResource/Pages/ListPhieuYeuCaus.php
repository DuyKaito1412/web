<?php

namespace App\Filament\User\Resources\PhieuYeuCauResource\Pages;

use App\Filament\User\Resources\PhieuYeuCauResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

class ListPhieuYeuCaus extends ListRecords
{
    protected static string $resource = PhieuYeuCauResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tạo phiếu báo hỏng'),
        ];
    }
}
