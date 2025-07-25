<?php

namespace App\Filament\User\Resources;

use App\Models\PhieuYeuCau;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Forms\Form;
use App\Filament\User\Resources\PhieuYeuCauResource\Pages;

class PhieuYeuCauResource extends Resource
{
    protected static ?string $model = PhieuYeuCau::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Phiếu Yêu Cầu';
    protected static ?string $pluralModelLabel = 'Phiếu Yêu Cầu';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('loai_su_co_id')
                ->label('Dịch vụ/Sự cố')
                ->relationship('loaiSuCo', 'ten_loai')
                ->required(),
            Forms\Components\TextInput::make('mo_ta_su_co')->label('Mô tả sự cố')->required(),
            Forms\Components\TextInput::make('dia_chi')->label('Địa chỉ')->required(),
            // Bỏ trường nhập số điện thoại, chỉ lấy từ user
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('Mã phiếu')->sortable(),
                Tables\Columns\TextColumn::make('loaiSuCo.ten_loai')->label('Dịch vụ'),
                Tables\Columns\TextColumn::make('mo_ta_su_co')->label('Mô tả sự cố'),
                Tables\Columns\TextColumn::make('trang_thai')->label('Trạng thái')->formatStateUsing(fn($state) => match($state) {
                    'đang gửi' => 'Phiếu đang được gửi',
                    'đã tiếp nhận' => 'Phiếu đã được tiếp nhận',
                    'đã giao kỹ thuật' => 'Đã giao kỹ thuật xử lý',
                    'hoàn thành' => 'Hoàn thành',
                    default => $state
                }),
                Tables\Columns\TextColumn::make('created_at')->label('Ngày gửi')->dateTime('d/m/Y H:i'),
                Tables\Columns\TextColumn::make('diem_so')->label('Điểm đánh giá')->sortable(),
                Tables\Columns\TextColumn::make('loi_nhan')->label('Lời nhắn đánh giá')->limit(30),
                Tables\Columns\TextColumn::make('user.so_dien_thoai')->label('Số điện thoại'),
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
                // Có thể thêm filter theo trạng thái
            ])
            ->actions([
                // Đánh giá khi hoàn thành
                \Filament\Tables\Actions\Action::make('danh_gia')
                    ->label('Đánh giá')
                    ->visible(fn ($record) => $record->trang_thai === 'hoàn thành' && $record->diem_so === null)
                    ->form([
                        \Filament\Forms\Components\Select::make('diem_so')
                            ->label('Điểm số')
                            ->options([
                                1 => '1 - Không hài lòng',
                                2 => '2 - Hơi không hài lòng',
                                3 => '3 - Bình thường',
                                4 => '4 - Hài lòng',
                                5 => '5 - Rất hài lòng',
                            ])->required(),
                        \Filament\Forms\Components\Textarea::make('loi_nhan')->label('Lời nhắn')->required(),
                    ])
                    ->action(function ($record, $data) {
                        $record->update([
                            'diem_so' => $data['diem_so'],
                            'loi_nhan' => $data['loi_nhan'],
                        ]);
                    }),
            ])
            ->paginationPageOptions([10, 25, 50]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPhieuYeuCaus::route('/'),
            'create' => Pages\CreatePhieuYeuCau::route('/create'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        // Chỉ lấy các yêu cầu của user hiện tại
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }
}
