<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NegotiateResource\Pages;
use App\Filament\Resources\NegotiateResource\RelationManagers;
use App\Models\Negotiate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NegotiateResource extends Resource
{
    protected static ?string $model = Negotiate::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('vendor_id')->relationship('vendor', 'company_name')->required(),
                Forms\Components\Textarea::make('result')->required()->maxLength('1000'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('vendor.company_name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('result')->label('Result')->sortable()->searchable(),
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
            'index' => Pages\ListNegotiates::route('/'),
            'create' => Pages\CreateNegotiate::route('/create'),
            'edit' => Pages\EditNegotiate::route('/{record}/edit'),
        ];
    }
}
