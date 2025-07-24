<?php

namespace App\Filament\NhanVienKyThuat\Resources\PhieuYeuCauResource\Pages;

use App\Filament\NhanVienKyThuat\Resources\PhieuYeuCauResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPhieuYeuCau extends EditRecord
{
    protected static string $resource = PhieuYeuCauResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
