<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\PhieuYeuCau;

class PhieuYeuCauPieChart extends ChartWidget
{
    protected static ?string $heading = 'Tỉ lệ trạng thái phiếu báo hỏng';
    protected static ?string $description = 'Phân bố các trạng thái phiếu báo hỏng trong tháng hiện tại.';

    public static function getDefaultColumnSpan(): int
    {
        return 12;
    }

    protected function getData(): array
    {
        $month = now()->month;
        $year = now()->year;
        $trangThais = [
            'đang gửi' => 'Đang gửi',
            'đã tiếp nhận' => 'Đã tiếp nhận',
            'đã giao kỹ thuật' => 'Đã giao kỹ thuật',
            'đang xử lý' => 'Đang xử lý',
            'hoàn thành' => 'Hoàn thành',
        ];
        $counts = [];
        $labels = [];
        $colors = ['#f59e42', '#2563eb', '#10b981', '#f43f5e', '#6366f1'];
        foreach ($trangThais as $key => $label) {
            $labels[] = $label;
            $counts[] = PhieuYeuCau::where('trang_thai', $key)
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->count();
        }
        return [
            'datasets' => [
                [
                    'label' => 'Trạng thái phiếu',
                    'data' => $counts,
                    'backgroundColor' => $colors,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                    'labels' => [
                        'color' => '#2563eb',
                        'font' => [ 'size' => 16, 'weight' => 'bold' ],
                    ],
                ],
                'tooltip' => [
                    'enabled' => true,
                    'backgroundColor' => '#fff',
                    'titleColor' => '#2563eb',
                    'bodyColor' => '#333',
                    'borderColor' => '#2563eb',
                    'borderWidth' => 1,
                ],
            ],
            'elements' => [
                'arc' => [
                    'borderWidth' => 3,
                    'borderColor' => '#fff',
                ],
            ],
            'cutout' => '70%',
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
