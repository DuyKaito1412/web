<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\PhieuYeuCauPieChart;
use App\Filament\Widgets\PhieuYeuCauBarChart;

class AdminDashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public function getWidgets(): array
    {
        return [
            PhieuYeuCauPieChart::class,
            PhieuYeuCauBarChart::class,
        ];
    }
}
