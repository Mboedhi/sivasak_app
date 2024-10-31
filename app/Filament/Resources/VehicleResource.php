<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleResource\Pages;
use App\Filament\Resources\VehicleResource\RelationManagers;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')->relationship('user', 'name')->required(),
                Forms\Components\TextInput::make('vehicle_plate')->required()->maxLength(255),
                Forms\Components\TextInput::make('vehicle_type')->required()->maxLength(255),
                Forms\Components\TextInput::make('vehicle_registration')->required()->maxLength(255),
                Forms\Components\DatePicker::make('vehicle_tax')->required(),
                Forms\Components\Select::make('operate_status')->options([
                    'active' => 'Active',
                    'non_active' => 'Non Active',
                ])->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('vehicle_plate'),
                Tables\Columns\TextColumn::make('vehicle_type'),
                Tables\Columns\TextColumn::make('vehicle_registration'),
                Tables\Columns\TextColumn::make('vehicle_tax')->date(),
                Tables\Columns\TextColumn::make('operate_status')->enum([
                    'active' => 'Active',
                    'non_active' => 'Non Active',
                ]),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }
}
