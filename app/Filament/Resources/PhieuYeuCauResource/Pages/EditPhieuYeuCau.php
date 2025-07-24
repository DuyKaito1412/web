<?php

namespace App\Filament\Resources\PhieuYeuCauResource\Pages;

use App\Filament\Resources\PhieuYeuCauResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Carbon;

class EditPhieuYeuCau extends EditRecord
{
    protected static string $resource = PhieuYeuCauResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Nếu trạng thái là hoàn thành, tính đúng tiến độ
        if (($data['trang_thai'] ?? null) === 'hoàn thành') {
            $thoi_gian_tiep_nhan = isset($data['thoi_gian_tiep_nhan']) ? Carbon::parse($data['thoi_gian_tiep_nhan']) : null;
            $thoi_gian_hoan_thanh = isset($data['thoi_gian_hoan_thanh']) ? Carbon::parse($data['thoi_gian_hoan_thanh']) : now();
            if ($thoi_gian_tiep_nhan) {
                $diff = $thoi_gian_hoan_thanh->diffInMinutes($thoi_gian_tiep_nhan);
                $data['dung_tien_do'] = $diff <= 120;
            } else {
                $data['dung_tien_do'] = null;
            }
        }
        return $data;
    }
}
