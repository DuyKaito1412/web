<x-filament::page>
    <div class="p-6 space-y-4">
        <h2 class="text-xl font-bold mb-4">Chi tiết đánh giá tiến độ</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div><strong>Mã phiếu:</strong> {{ $record->id }}</div>
            <div><strong>Khách hàng:</strong> {{ optional($record->user)->ho_ten }}</div>
            <div><strong>Dịch vụ/Sự cố:</strong> {{ optional($record->loaiSuCo)->ten_loai }}</div>
            <div><strong>Trạng thái:</strong> {{ $record->trang_thai }}</div>
            <div><strong>Nhận phiếu:</strong> {{ optional($record->thoi_gian_tiep_nhan)?->format('d/m/Y H:i') }}</div>
            <div>
                <strong>Thời gian xử lý:</strong>
                @if($record->thoi_gian_tiep_nhan && $record->thoi_gian_hoan_thanh)
                    {{ round(abs(\Carbon\Carbon::parse($record->thoi_gian_hoan_thanh)->floatDiffInMinutes(\Carbon\Carbon::parse($record->thoi_gian_tiep_nhan)))) }} phút
                @else
                    -
                @endif
            </div>
            <div><strong>Đúng tiến độ:</strong> {{ $record->dung_tien_do ? 'Có' : 'Không' }}</div>
            <div class="md:col-span-2"><strong>Nhận xét tiến độ (admin):</strong> {{ $record->nhan_xet_tien_do }}</div>
            <div><strong>Điểm đánh giá user:</strong> {{ $record->diem_so }}</div>
            <div class="md:col-span-2"><strong>Nhận xét user:</strong> {{ $record->loi_nhan }}</div>
        </div>
    </div>
</x-filament::page>
