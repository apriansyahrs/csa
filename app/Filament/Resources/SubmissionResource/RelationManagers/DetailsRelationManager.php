<?php

namespace App\Filament\Resources\SubmissionResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DetailsRelationManager extends RelationManager
{
    protected static string $relationship = 'details';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('submission_id')
            ->columns([
                TextColumn::make('item.name')->label('Item'),
                TextColumn::make('item.price')->label('Harga'),
                TextColumn::make('description')->label('Keterangan'),
                TextColumn::make('qty_remaining')->label('Sisa'),
                TextColumn::make('qty_submission')->label('Request'),
                TextColumn::make('qty_approved')->label('Jml disetujui'),
                TextColumn::make('item.total')->label('Total'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
