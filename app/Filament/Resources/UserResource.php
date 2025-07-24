<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Support\Facades\FilamentView;
use Filament\Facades\Filament;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Người dùng';
    protected static ?string $modelLabel = 'Người dùng';
    protected static ?string $pluralModelLabel = 'Người dùng';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('ho_ten')->label('Họ tên')->required(),
                Forms\Components\TextInput::make('email')->label('Email')->email()->required(),
                Forms\Components\TextInput::make('so_dien_thoai')->label('Số điện thoại'),
                Forms\Components\TextInput::make('vai_tro')->label('Vai trò'),
                Forms\Components\TextInput::make('mat_khau')->label('Mật khẩu')->password()->required(fn($context) => $context === 'create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('ho_ten')->label('Họ tên'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('so_dien_thoai')->label('Số điện thoại'),
                Tables\Columns\TextColumn::make('vai_tro')->label('Vai trò'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Sửa'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Xóa'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    // Thay thế canViewAny bằng cách kiểm tra quyền khác
    public static function shouldRegisterNavigation(): bool
    {
        return Filament::auth()->user()?->vai_tro === 'admin';
    }
}
