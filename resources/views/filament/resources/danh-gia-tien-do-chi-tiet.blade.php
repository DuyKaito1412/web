<div class="p-6 space-y-4">
    <h2 class="text-xl font-bold mb-4">Chi tiết đánh giá tiến độ</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div><strong>Mã phiếu:</strong> {{ $ma_phieu }}</div>
        <div><strong>Khách hàng:</strong> {{ $khach_hang }}</div>
        <div><strong>Dịch vụ/Sự cố:</strong> {{ $dich_vu }}</div>
        <div><strong>Trạng thái:</strong> {{ $trang_thai }}</div>
        <div><strong>Nhận phiếu:</strong> {{ $nhan_phieu }}</div>
        <div><strong>Thời gian xử lý:</strong> {{ $thoi_gian_xu_ly }}</div>
        <div><strong>Đúng tiến độ:</strong> {{ $dung_tien_do }}</div>
        <div class="md:col-span-2"><strong>Nhận xét tiến độ (admin):</strong> {{ $nhan_xet_tien_do }}</div>
        <div><strong>Điểm đánh giá user:</strong> {{ $diem_so }}</div>
        <div class="md:col-span-2"><strong>Nhận xét user:</strong> {{ $loi_nhan }}</div>
    </div>
</div>
