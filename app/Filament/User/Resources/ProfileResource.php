<?php

namespace App\Filament\User\Resources;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\User\Resources\ProfileResource\Pages;

class ProfileResource extends Resource
{
    protected static ?string $model = User::class;

    public static function canViewAny(): bool
    {
        return auth()->user()?->vai_tro === 'user';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('ho_ten')
                    ->label('Họ tên')
                    ->required(),
                Forms\Components\TextInput::make('so_dien_thoai')
                    ->label('Số điện thoại')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->label('Email')
                    ->required(),
                Forms\Components\TextInput::make('mat_khau')
                    ->label('Mật khẩu mới')
                    ->password()
                    ->revealable()
                    ->dehydrateStateUsing(fn($state) => $state ? bcrypt($state) : null)
                    ->required(fn($context) => $context === 'create')
                    ->confirmed(),
                Forms\Components\TextInput::make('mat_khau_confirmation')
                    ->label('Nhập lại mật khẩu mới')
                    ->password()
                    ->revealable()
                    ->required(fn($context) => $context === 'create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Các cột hiển thị
            ])
            ->actions([
                // Các hành động
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\EditProfile::route('/'),
            'edit' => Pages\EditProfile::route('/edit'),
        ];
    }
}
