<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\User;

class UserStats extends Widget
{
    protected static string $view = 'filament.widgets.user-stats';

    protected function getViewData(): array
    {
        return [
            'userCount' => User::count(),
        ];
    }

    public static function getDefaultColumnSpan(): int
    {
        return 12;
    }
}
