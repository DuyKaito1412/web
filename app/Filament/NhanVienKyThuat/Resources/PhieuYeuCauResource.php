<?php

namespace App\Filament\NhanVienKyThuat\Resources;

use App\Filament\NhanVienKyThuat\Resources\PhieuYeuCauResource\Pages;
use App\Filament\NhanVienKyThuat\Resources\PhieuYeuCauResource\RelationManagers;
use App\Models\PhieuYeuCau;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PhieuYeuCauResource extends Resource
{
    protected static ?string $model = PhieuYeuCau::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Tiếp nhận phiếu báo hỏng';
    protected static ?string $modelLabel = 'Tiếp nhận phiếu báo hỏng';
    protected static ?string $pluralModelLabel = 'Tiếp nhận phiếu báo hỏng';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('Mã phiếu')->sortable(),
                Tables\Columns\TextColumn::make('user.ho_ten')->label('Khách hàng'),
                Tables\Columns\TextColumn::make('user.so_dien_thoai')->label('Số điện thoại'),
                Tables\Columns\TextColumn::make('dia_chi')->label('Địa chỉ'),
                Tables\Columns\TextColumn::make('loaiSuCo.ten_loai')->label('Dịch vụ/Sự cố'),
                Tables\Columns\TextColumn::make('mo_ta_su_co')->label('Mô tả sự cố'),
                Tables\Columns\TextColumn::make('trang_thai')->label('Trạng thái'),
                Tables\Columns\TextColumn::make('created_at')->label('Ngày gửi')->dateTime('d/m/Y H:i'),
            ])
            ->filters([
                \Filament\Tables\Filters\Filter::make('created_at')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('from')->label('Từ ngày'),
                        \Filament\Forms\Components\DatePicker::make('to')->label('Đến ngày'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn($q) => $q->whereDate('created_at', '>=', $data['from']))
                            ->when($data['to'], fn($q) => $q->whereDate('created_at', '<=', $data['to']));
                    }),
                // Có thể thêm filter theo trạng thái nếu muốn
            ])
            ->actions([
                Tables\Actions\Action::make('nhan_phieu')
                    ->label('Nhận phiếu')
                    ->visible(fn ($record) => $record->trang_thai === 'đã giao kỹ thuật')
                    ->action(function ($record) {
                        $record->update([
                            'trang_thai' => 'đang xử lý',
                            'thoi_gian_tiep_nhan' => now(),
                        ]);
                    }),
                Tables\Actions\Action::make('hoan_thanh')
                    ->label('Hoàn thành')
                    ->visible(fn ($record) => $record->trang_thai === 'đang xử lý')
                    ->form([
                        \Filament\Forms\Components\Textarea::make('ket_qua_xu_ly')->label('Kết quả xử lý')->required(),
                    ])
                    ->action(function ($record, $data) {
                        $dung_tien_do = false;
                        if ($record->thoi_gian_tiep_nhan) {
                            $diff = now()->diffInMinutes($record->thoi_gian_tiep_nhan);
                            $dung_tien_do = $diff <= 120;
                        }
                        $record->update([
                            'trang_thai' => 'hoàn thành',
                            'thoi_gian_hoan_thanh' => now(),
                            'ket_qua_xu_ly' => $data['ket_qua_xu_ly'],
                            'dung_tien_do' => $dung_tien_do,
                        ]);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('nhan_vien_ky_thuat_id', auth()->id())
            ->whereIn('trang_thai', ['đã giao kỹ thuật', 'đang xử lý']);
    }

    // Ghi đè page ListPhieuYeuCaus để ẩn nút tạo mới
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPhieuYeuCaus::route('/'),
            'create' => Pages\CreatePhieuYeuCau::route('/create'),
            'edit' => Pages\EditPhieuYeuCau::route('/{record}/edit'),
        ];
    }
}
