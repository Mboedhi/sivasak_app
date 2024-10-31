<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComplainResource\Pages;
use App\Filament\Resources\ComplainResource\RelationManagers;
use App\Models\Complain;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComplainResource extends Resource
{
    protected static ?string $model = Complain::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')->relationship('user', 'name')->required(),
                Forms\Components\Select::make('vehicle_id')->relationship('vehicle', 'vehicle_plate')->require(),
                Forms\Components\Textarea::make('complain_desc')->required()->maxLength(500),
                Forms\Components\Select::make('complain_status')->options([
                    'accepted' => 'Accepted',
                    'rejected' => 'Rejected',
                    'pending' => 'Pending',
                ])->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('User Name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('vehicle.vehicle_plate')->label('Vehicle Plate')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('complain_desc')->label('Description')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('complain_status')->enum([
                    'accepted' => 'Accepted',
                    'rejected' => 'Rejected',
                    'pending' => 'Pending',
                ])->label('Status'),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
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
            'index' => Pages\ListComplains::route('/'),
            'create' => Pages\CreateComplain::route('/create'),
            'edit' => Pages\EditComplain::route('/{record}/edit'),
        ];
    }
}
