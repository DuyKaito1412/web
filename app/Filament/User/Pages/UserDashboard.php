<?php

namespace App\Filament\User\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class UserDashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $title =     'Bảng Điều Khiển Người Dùng';

    public static function canAccess(): bool
    {
        return \Illuminate\Support\Facades\Auth::check();
    }
}
