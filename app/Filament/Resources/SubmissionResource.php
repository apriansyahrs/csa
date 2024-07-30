<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubmissionResource\Pages;
use App\Filament\Resources\SubmissionResource\RelationManagers;
use App\Models\Item;
use App\Models\Submission;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class SubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('File Uploads')
                    ->columnSpan(1)
                    ->schema([
                        FileUpload::make('request_file_1')
                            ->label('Upload bukti telah disetujui Atasan (jpg, jpeg, png, pdf)')
                            ->nullable(),
                        FileUpload::make('request_file_2')
                            ->label('Upload bukti telah disetujui COO (jpg, jpeg, png, pdf)')
                            ->nullable(),
                    ])->columns(1),
                Grid::make()
                    ->schema([
                        Select::make('submission_category_id')
                            ->label('Submission Category')
                            ->relationship('submissionCategory', 'name')
                            ->required()
                            ->reactive() // Make the field reactive
                            ->afterStateUpdated(fn (callable $set) => $set('item_id', null))
                            ->columnSpan(3),

                        Repeater::make('details')
                            ->columnSpan(3)
                            ->schema([
                                Select::make('item_id')
                                    ->label('Item')
                                    ->options(function (callable $get) {
                                        $categoryId = $get('../../submission_category_id');
                                        if ($categoryId) {
                                            return Item::where('item_category_id', $categoryId)->pluck('name', 'id');
                                        }
                                        return Item::all()->pluck('name', 'id');
                                    })
                                    ->searchable()
                                    ->required(),
                                TextInput::make('qty_remaining')
                                    ->label('Quantity Remaining')
                                    ->numeric()
                                    ->required(),
                                TextInput::make('qty_submission')
                                    ->label('Quantity Submission')
                                    ->numeric()
                                    ->nullable(),
                                TextInput::make('description')
                                    ->label('Description')
                                    ->nullable(),
                            ])
                            ->columns(4),
                    ])
                    ->columnSpan(3),
            ])->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')->label('Code')->searchable(),
                TextColumn::make('user.name')->label('Pemohon')->searchable(),
                TextColumn::make('date')->label('Diajukan pada')->date(),
                TextColumn::make('submissionCategory.name')->label('Tipe pengajuan'),
                TextColumn::make('request_file_1')
                    ->label('Lampiran 1')
                    ->getStateUsing(function ($record) {
                        return $record->request_file_1
                            ? '<a href="' . asset('storage/' . $record->request_file_1) . '" target="_blank" class="fi-ta-text-item-label text-sm leading-6 text-gray-950 dark:text-white underline">Lihat File</a>'
                            : '-';
                    })
                    ->extraAttributes(['class' => 'px-4 py-2'])
                    ->html(),  // Ini penting agar HTML di render sebagai link
                TextColumn::make('request_file_2')
                    ->label('Lampiran 2')
                    ->getStateUsing(function ($record) {
                        return $record->request_file_2
                            ? '<a href="' . asset('storage/' . $record->request_file_2) . '" target="_blank" class="fi-ta-text-item-label text-sm leading-6 text-gray-950 dark:text-white underline">Lihat File</a>'
                            : '-';
                    })
                    ->extraAttributes(['class' => 'px-4 py-2'])
                    ->html(),  // Ini penting agar HTML di render sebagai link
                // Column untuk status_po
                TextColumn::make('status_po')
                    ->label('Status PO')
                    ->getStateUsing(function ($record) {
                        $approval = $record->approvals->firstWhere('approval_type', 'ACCOUNTING');
                        if ($approval) {
                            return $approval->approved_by === null
                                ? ($record->status_po == 0 ? '' : 'YA')
                                : ($record->status_po == 0 ? 'TIDAK' : 'YA');
                        }
                        return '-';
                    }),


                // Column untuk disetujui oleh
                TextColumn::make('approved_by')
                    ->label('Disetujui Oleh')
                    ->getStateUsing(function ($record) {
                        if ($record->submission_category_id == 2 || $record->submission_category_id == 3) {
                            $approval = $record->approvals->firstWhere('approval_type', 'MANAGER');
                            return $approval && $approval->approved_by ? ($approval->approvedBy ? $approval->approvedBy->name : '-') : '-';
                        }
                        return '-';
                    }),

                // Column untuk disetujui pada
                TextColumn::make('approved_at')
                    ->label('Disetujui Pada')
                    ->getStateUsing(function ($record) {
                        if ($record->submission_category_id == 2 || $record->submission_category_id == 3) {
                            $approval = $record->approvals->firstWhere('approval_type', 'MANAGER');
                            return $approval && $approval->approved_by ? \Carbon\Carbon::parse($approval->approved_at)->format('M d, Y') : '-';
                        }
                        return '-';
                    }),

                // Column untuk diproses oleh
                TextColumn::make('processed_by')
                    ->label('Diproses Oleh')
                    ->getStateUsing(function ($record) {
                        $approval = $record->approvals->firstWhere('approval_type', 'EXECUTOR');
                        return $approval && $approval->approved_by ? ($approval->approvedBy ? $approval->approvedBy->name : '-') : '-';
                    }),

                TextColumn::make('status_client')
                    ->label('Status Akhir')
                    ->badge()
                    ->colors([
                        'warning' => fn ($state) => $state === 0,
                        'success' => fn ($state) => $state === 1,
                        'info' => fn ($state) => $state === 3,
                        'primary' => fn ($state) => $state === 4,
                        'danger' => fn ($state) => $state === 2,
                    ])
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            0 => 'MENUNGGU',
                            1 => 'DITERIMA',
                            2 => 'DIBATALKAN',
                            3 => 'DIPROSES',
                            4 => 'SELESAI',
                            default => 'Unknown',
                        };
                    }),
            ])
            ->filters([
                SelectFilter::make('status_client')
                    ->label('Status Akhir')
                    ->options([
                        0 => 'MENUNGGU',
                        1 => 'DITERIMA',
                        2 => 'DIBATALKAN',
                        3 => 'DIPROSES',
                        4 => 'SELESAI',
                    ]),
                SelectFilter::make('submissionCategory.name')
                    ->label('Tipe Pengajuan')
                    ->relationship('submissionCategory', 'name')
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('date', 'desc')
            ->paginated([10, 25, 50, 100]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\DetailsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubmissions::route('/'),
            'create' => Pages\CreateSubmission::route('/create'),
            'view' => Pages\ViewSubmission::route('/{record}'),
            'edit' => Pages\EditSubmission::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where(function ($query) {
                // Display all tickets to Super Admin
                if (auth()->user()->hasRole('super_admin')) {
                    return;
                }
                // if (auth()->user()->hasRole('Admin Unit')) {
                //     $query->where('tickets.unit_id', auth()->user()->unit_id)->orWhere('tickets.owner_id', auth()->id());
                // } elseif (auth()->user()->hasRole('Staff Unit')) {
                //     $query->where('tickets.responsible_id', auth()->id())->orWhere('tickets.owner_id', auth()->id());
                // } else {
                //     $query->where('tickets.owner_id', auth()->id());
                // }

                $query->where('submissions.user_id', auth()->id());
            });
    }
}
