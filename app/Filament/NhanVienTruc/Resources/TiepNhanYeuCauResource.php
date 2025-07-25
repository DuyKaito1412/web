<?php

namespace App\Filament\NhanVienTruc\Resources;

use App\Filament\NhanVienTruc\Resources\TiepNhanYeuCauResource\Pages\ListTiepNhanYeuCaus;
use App\Filament\NhanVienTruc\Resources\TiepNhanYeuCauResource\Pages\CreateTiepNhanYeuCau;
use App\Filament\NhanVienTruc\Resources\TiepNhanYeuCauResource\Pages\EditTiepNhanYeuCau;
use App\Filament\NhanVienTruc\Resources\TiepNhanYeuCauResource\RelationManagers;
use App\Models\PhieuYeuCau;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TiepNhanYeuCauResource extends Resource
{
    protected static ?string $model = PhieuYeuCau::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Xử lý phiếu yêu cầu';
    protected static ?string $modelLabel = 'Xử lý phiếu yêu cầu';
    protected static ?string $pluralModelLabel = 'Xử lý phiếu yêu cầu';

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
                Tables\Actions\Action::make('xac_thuc_giao_ky_thuat')
                    ->label('Xác thực & Giao kỹ thuật')
                    ->visible(fn ($record) => in_array($record->trang_thai, ['đang gửi', 'đã tiếp nhận']))
                    ->form([
                        \Filament\Forms\Components\Select::make('nhan_vien_ky_thuat_id')
                            ->label('Chọn nhân viên kỹ thuật')
                            ->options(\App\Models\User::where('vai_tro', 'nhanvien_ky_thuat')->pluck('ho_ten', 'id'))
                            ->required(),
                        \Filament\Forms\Components\Textarea::make('ghi_chu')->label('Ghi chú')->rows(2),
                    ])
                    ->action(function ($record, $data) {
                        $record->update([
                            'trang_thai' => 'đã giao kỹ thuật',
                            'nhan_vien_ky_thuat_id' => $data['nhan_vien_ky_thuat_id'],
                            'ghi_chu' => $data['ghi_chu'] ?? null,
                            'thoi_gian_giao_ky_thuat' => now(),
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

    public static function getPages(): array
    {
        return [
            'index' => ListTiepNhanYeuCaus::route('/'),
            'create' => CreateTiepNhanYeuCau::route('/create'),
            'edit' => EditTiepNhanYeuCau::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereIn('trang_thai', ['đang gửi', 'đã tiếp nhận']);
    }
}
