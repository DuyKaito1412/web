<?php

namespace App\Filament\Resources\DanhGiaTienDoResource\Pages;

use App\Filament\Resources\DanhGiaTienDoResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Placeholder;

class ViewDanhGiaTienDo extends ViewRecord
{
    protected static string $resource = DanhGiaTienDoResource::class;

    protected function getFormSchema(): array
    {
        $record = $this->record;
        $thoiGianXuLy = null;
        if ($record->thoi_gian_tiep_nhan && $record->thoi_gian_hoan_thanh) {
            $diff = abs(\Carbon\Carbon::parse($record->thoi_gian_hoan_thanh)->floatDiffInMinutes(\Carbon\Carbon::parse($record->thoi_gian_tiep_nhan)));
            $thoiGianXuLy = round($diff) . ' phút';
        }
        return [
            Card::make([
                Placeholder::make('Mã phiếu')->content($record->id),
                Placeholder::make('Khách hàng')->content(optional($record->user)->ho_ten),
                Placeholder::make('Dịch vụ/Sự cố')->content(optional($record->loaiSuCo)->ten_loai),
                Placeholder::make('Trạng thái')->content($record->trang_thai),
                Placeholder::make('Nhận phiếu')->content(optional($record->thoi_gian_tiep_nhan)?->format('d/m/Y H:i')),
                Placeholder::make('Thời gian xử lý')->content($thoiGianXuLy ?? '-'),
                Placeholder::make('Đúng tiến độ')->content($record->dung_tien_do ? 'Có' : 'Không'),
                Placeholder::make('Nhận xét tiến độ (admin)')->content($record->nhan_xet_tien_do),
                Placeholder::make('Điểm đánh giá user')->content($record->diem_so),
                Placeholder::make('Nhận xét user')->content($record->loi_nhan),
            ])
        ];
    }
}
