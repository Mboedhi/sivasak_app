<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemAssessmentResource\Pages;
use App\Filament\Resources\ItemAssessmentResource\RelationManagers;
use App\Models\ItemAssessment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemAssessmentResource extends Resource
{
    protected static ?string $model = ItemAssessment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('vendor_id')->relationship('vendor', 'company_name')->required(),
                Forms\Components\Select::make('item_id')->relationship('item', 'item_name')->required(),
                Forms\Components\Select::make('assessment_status')->options([
                    'accepted' => "Accepted",
                    'rejected' => "Rejected",
                    'pending' => "Pending",                    
                ])->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('vendor.company_name'),
                Tables\Columns\TextColumn::make('item.item_name'),
                Tables\Columns\TextColumn::make('assessment_amount'),
                Tables\Columns\TextColumn::make('assessment_status')->enum([
                    'accepted' => "Accepted",
                    'rejected' => "Rejected",
                    'pending' => "Pending",
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
            'index' => Pages\ListItemAssessments::route('/'),
            'create' => Pages\CreateItemAssessment::route('/create'),
            'edit' => Pages\EditItemAssessment::route('/{record}/edit'),
        ];
    }
}
