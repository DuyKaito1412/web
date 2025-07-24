<?php

namespace App\Filament\User\Resources\PhieuYeuCauResource\Pages;

use App\Filament\User\Resources\PhieuYeuCauResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreatePhieuYeuCau extends CreateRecord
{
    protected static string $resource = PhieuYeuCauResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();
        $data['trang_thai'] = 'đang gửi';
        return $data;
    }
}
