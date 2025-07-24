<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhieuYeuCauResource\Pages;
use App\Models\PhieuYeuCau;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PhieuYeuCauResource extends Resource
{
    protected static ?string $model = PhieuYeuCau::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Phiếu báo hỏng';
    protected static ?string $modelLabel = 'Phiếu báo hỏng';
    protected static ?string $pluralModelLabel = 'Phiếu báo hỏng';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('user_id')
                ->label('Khách hàng')
                ->relationship('user', 'ho_ten')
                ->searchable()
                ->required(),
            Forms\Components\Select::make('loai_su_co_id')
                ->label('Dịch vụ/Sự cố')
                ->relationship('loaiSuCo', 'ten_loai')
                ->searchable()
                ->required(),
            Forms\Components\TextInput::make('mo_ta_su_co')->label('Mô tả sự cố')->required(),
            Forms\Components\TextInput::make('dia_chi')->label('Địa chỉ')->required(),
            Forms\Components\Select::make('trang_thai')->label('Trạng thái')->options([
                'đang gửi' => 'Đang gửi',
                'đã tiếp nhận' => 'Đã tiếp nhận',
                'đã giao kỹ thuật' => 'Đã giao kỹ thuật',
                'đang xử lý' => 'Đang xử lý',
                'hoàn thành' => 'Hoàn thành',
            ])->required(),
            Forms\Components\DateTimePicker::make('thoi_gian_tiep_nhan')->label('Thời gian tiếp nhận'),
            Forms\Components\DateTimePicker::make('thoi_gian_giao_ky_thuat')->label('Thời gian giao kỹ thuật'),
            Forms\Components\DateTimePicker::make('thoi_gian_hoan_thanh')->label('Thời gian hoàn thành'),
            Forms\Components\Select::make('nhan_vien_truc_id')
                ->label('Nhân viên trực')
                ->relationship('user', 'ho_ten')
                ->searchable(),
            Forms\Components\Select::make('nhan_vien_ky_thuat_id')
                ->label('Nhân viên kỹ thuật')
                ->relationship('user', 'ho_ten')
                ->searchable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('Mã phiếu')->sortable(),
                Tables\Columns\TextColumn::make('user.ho_ten')->label('Khách hàng'),
                Tables\Columns\TextColumn::make('loaiSuCo.ten_loai')->label('Dịch vụ/Sự cố'),
                Tables\Columns\TextColumn::make('mo_ta_su_co')->label('Mô tả sự cố'),
                Tables\Columns\TextColumn::make('trang_thai')->label('Trạng thái'),
                Tables\Columns\TextColumn::make('created_at')->label('Ngày gửi')->dateTime('d/m/Y H:i'),
            ])
            ->filters([
                // Có thể thêm filter theo trạng thái nếu muốn
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label('Xem chi tiết'),
                Tables\Actions\EditAction::make()->label('Sửa'),
                Tables\Actions\DeleteAction::make()->label('Xóa'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPhieuYeuCaus::route('/'),
            'create' => Pages\CreatePhieuYeuCau::route('/create'),
            'edit' => Pages\EditPhieuYeuCau::route('/{record}/edit'),
            'view' => Pages\ViewPhieuYeuCau::route('/{record}'),
        ];
    }
}
