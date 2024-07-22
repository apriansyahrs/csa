<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Area;
use App\Models\BusinessUnit;
use App\Models\Division;
use App\Models\JobLevel;
use App\Models\JobPosition;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->schema([
                        // Kiri
                        Grid::make(2) // Dua kolom di Kiri
                        ->schema([
                            Section::make('Personal Information')
                                ->schema([
                                    TextInput::make('name')
                                        ->label('Full Name')
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('username')
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('email')
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('mobile_phone')
                                        ->label('Mobile Phone')
                                        ->required()
                                        ->maxLength(255),
                                ])
                                ->columns(2), // Dua kolom di Kiri

                            Section::make('Security Information')
                                ->schema([
                                    TextInput::make('password')
                                        ->password()
                                        ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                                        ->dehydrated(fn ($state) => filled($state))
                                        ->required(fn (string $context): bool => $context === 'create')
                                        ->maxLength(255),
                                    DateTimePicker::make('email_verified_at')
                                        ->label('Email Verified At'),
                                ])
                                ->columns(2), // Dua kolom di Kiri
                        ])
                        ->columnSpan(2), // Menetapkan ini ke kolom 2 (Kiri)

                        // Kanan
                        Grid::make(1) // Satu kolom di kanan
                            ->schema([
                                Section::make('Pekerjaan')
                                    ->schema([
                                        Select::make('business_unit_id')
                                            ->label('Business Unit')
                                            ->options(BusinessUnit::all()->pluck('name', 'id'))
                                            ->createOptionForm([
                                                TextInput::make('code')
                                                    ->required(),
                                                TextInput::make('name')
                                                    ->required(),
                                                Select::make('color')
                                                    ->label('Color')
                                                    ->options(BusinessUnit::COLORS)
                                                    ->required(),
                                            ])
                                            ->createOptionUsing(function (array $data): int {
                                                $businessUnit = BusinessUnit::create($data);
                                                return $businessUnit->id;
                                            })
                                            ->searchable()
                                            ->required(),
                                        Select::make('area_id')
                                            ->label('Area')
                                            ->options(Area::all()->pluck('name', 'id'))
                                            ->createOptionForm([
                                                TextInput::make('name')
                                                    ->required(),
                                            ])
                                            ->createOptionUsing(function (array $data): int {
                                                $area = Area::create($data);
                                                return $area->id;
                                            })
                                            ->searchable()
                                            ->required(),
                                        Select::make('division_id')
                                            ->label('Division')
                                            ->options(Division::all()->pluck('name', 'id'))
                                            ->createOptionForm([
                                                TextInput::make('name')
                                                    ->required(),
                                                Select::make('area_id')
                                                    ->label('Area')
                                                    ->options(Area::all()->pluck('name', 'id'))  // pastikan Area model sudah ter-import
                                                    ->required(),
                                            ])
                                            ->createOptionUsing(function (array $data): int {
                                                $division = Division::create($data);
                                                return $division->id;
                                            })
                                            ->searchable()
                                            ->required(),
                                            Select::make('job_level_id')
                                            ->label('Job Level')
                                            ->options(JobLevel::all()->pluck('name', 'id'))
                                            ->createOptionForm([
                                                TextInput::make('name')
                                                    ->required(),
                                            ])
                                            ->createOptionUsing(function (array $data): int {
                                                $jobLevel = JobLevel::create($data);
                                                return $jobLevel->id;
                                            })
                                            ->searchable()
                                            ->required(),
                                        Select::make('job_position_id')
                                            ->label('Job Position')
                                            ->options(JobPosition::all()->pluck('name', 'id'))
                                            ->createOptionForm([
                                                TextInput::make('name')
                                                    ->required(),
                                            ])
                                            ->createOptionUsing(function (array $data): int {
                                                $jobPosition = JobPosition::create($data);
                                                return $jobPosition->id;
                                            })
                                            ->searchable()
                                            ->required(),
                                    ])
                                    ->columns(1), // Satu kolom di kanan
                            ])
                            ->columnSpan(1), // Menetapkan ini ke kolom 1 (kanan)
                    ])
                    ->columns(3), // Total layout dibagi menjadi 3 kolom, dengan kiri 2 dan kanan 1
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('businessUnit.code')
                    ->badge()
                    ->color(fn ($record) => $record->businessUnit->color ?? 'gray')
                    ->getStateUsing(fn ($record) => $record->businessUnit->code ?? 'N/A')
                    ->searchable(),
                TextColumn::make('division.name')
                    ->searchable(),
                TextColumn::make('jobPosition.name')
                    ->searchable(),
                TextColumn::make('jobLevel.name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
