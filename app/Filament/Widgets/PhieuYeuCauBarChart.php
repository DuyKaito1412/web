<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\PhieuYeuCau;
use Illuminate\Support\Carbon;

class PhieuYeuCauBarChart extends ChartWidget
{
    protected static ?string $heading = 'Biểu đồ số lượng phiếu báo hỏng theo tháng';
    protected static ?string $description = 'Thống kê số lượng phiếu báo hỏng được tạo trong từng tháng của năm hiện tại.';

    public static function getDefaultColumnSpan(): int
    {
        return 12;
    }

    protected function getData(): array
    {
        $year = now()->year;
        $labels = [];
        $data = [];
        for ($month = 1; $month <= 12; $month++) {
            $labels[] = sprintf('%02d/%d', $month, $year);
            $data[] = PhieuYeuCau::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->count();
        }
        return [
            'datasets' => [
                [
                    'label' => 'Số lượng phiếu',
                    'data' => $data,
                    'backgroundColor' => '#2563eb',
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
            'scales' => [
                'x' => [
                    'grid' => [ 'display' => false ],
                    'ticks' => [ 'color' => '#2563eb', 'font' => [ 'size' => 14 ] ],
                ],
                'y' => [
                    'grid' => [ 'color' => '#e0e7ef' ],
                    'ticks' => [ 'color' => '#2563eb', 'font' => [ 'size' => 14 ] ],
                ],
            ],
            'elements' => [
                'bar' => [
                    'borderRadius' => 8,
                    'backgroundColor' => 'rgba(37,99,235,0.8)',
                    'borderSkipped' => false,
                    'borderWidth' => 2,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
