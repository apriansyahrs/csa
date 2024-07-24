<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemResource\Pages;
use App\Filament\Resources\ItemResource\RelationManagers;
use App\Models\Item;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('code')
                    ->required()
                    ->unique(),
                TextInput::make('name')
                    ->required(),
                Select::make('item_category_id')
                    ->relationship('itemCategory', 'name')
                    ->required(),
                Select::make('item_unit_type_id')
                    ->relationship('itemUnitType', 'name')
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric(),
                Textarea::make('description'),
                FileUpload::make('image'),
                TextInput::make('stock')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('itemCategory.name'),
                Tables\Columns\TextColumn::make('itemUnitType.name'),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('stock'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->deferLoading();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageItems::route('/'),
        ];
    }
}
