<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComplainResponseResource\Pages;
use App\Filament\Resources\ComplainResponseResource\RelationManagers;
use App\Models\ComplainResponse;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComplainResponseResource extends Resource
{
    protected static ?string $model = ComplainResponse::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('complain_id')->relationship('complain', 'complain_desc')->required(),
                Forms\Components\Textarea::make('response')->required()->maxLength(500),
                Forms\Components\DatePicker::make('response_date')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('complain.complain_desc')->label('Complain Description')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('response')->label('Response')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('response_date')->label('Response Date')->date(),
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
            'index' => Pages\ListComplainResponses::route('/'),
            'create' => Pages\CreateComplainResponse::route('/create'),
            'edit' => Pages\EditComplainResponse::route('/{record}/edit'),
        ];
    }
}
