<?php

namespace App\Filament\Resources;

use App\Models\PhieuYeuCau;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DanhGiaTienDoResource extends Resource
{
    protected static ?string $model = PhieuYeuCau::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationLabel = 'Đánh giá tiến độ';
    protected static ?string $modelLabel = 'Đánh giá tiến độ';
    protected static ?string $pluralModelLabel = 'Đánh giá tiến độ';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('Mã phiếu')->sortable(),
                Tables\Columns\TextColumn::make('user.ho_ten')->label('Khách hàng'),
                Tables\Columns\TextColumn::make('loaiSuCo.ten_loai')->label('Dịch vụ/Sự cố'),
                Tables\Columns\TextColumn::make('trang_thai')->label('Trạng thái'),
                Tables\Columns\TextColumn::make('thoi_gian_tiep_nhan')->label('Nhận phiếu')->dateTime('d/m/Y H:i'),
                Tables\Columns\TextColumn::make('thoi_gian_xu_ly')->label('Thời gian xử lý')->getStateUsing(function($record) {
                    if ($record->thoi_gian_tiep_nhan && $record->thoi_gian_hoan_thanh) {
                        $diff = abs(\Carbon\Carbon::parse($record->thoi_gian_hoan_thanh)->floatDiffInMinutes(\Carbon\Carbon::parse($record->thoi_gian_tiep_nhan)));
                        return round($diff) . ' phút';
                    }
                    return null;
                }),
                Tables\Columns\BooleanColumn::make('dung_tien_do')->label('Đúng tiến độ')->trueIcon('heroicon-o-check')->falseIcon('heroicon-o-x-mark')->sortable(),
                Tables\Columns\TextColumn::make('nhan_xet_tien_do')->label('Nhận xét tiến độ (admin)')->limit(20)->tooltip(fn($record) => $record->nhan_xet_tien_do),
                Tables\Columns\TextColumn::make('diem_so')->label('Điểm đánh giá user')->badge()->color(fn($state) => $state <= 2 ? 'danger' : ($state == 3 ? 'warning' : ($state >= 4 ? 'success' : 'secondary')))->sortable(),
                Tables\Columns\TextColumn::make('loi_nhan')->label('Nhận xét user')->limit(20)->tooltip(fn($record) => $record->loi_nhan),
            ])
            ->filters([
                // Có thể thêm filter theo đúng tiến độ, điểm số, ...
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label('Xem chi tiết'),
                // Bỏ các action đánh giá/chấm điểm
            ]);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        // Chỉ lấy các phiếu đã hoàn thành
        return PhieuYeuCau::query()->where('trang_thai', 'hoàn thành');
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\DanhGiaTienDoResource\Pages\ListDanhGiaTienDos::route('/'),
            'view' => \App\Filament\Resources\DanhGiaTienDoResource\Pages\ViewDanhGiaTienDo::route('/{record}'),
        ];
    }
}
