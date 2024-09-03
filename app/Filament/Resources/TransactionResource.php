<?php

namespace App\Filament\Resources;

use App\Filament\Exports\TransactionExporter;
use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationGroup = 'Transaction Management';

    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('phone_number')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('trx_id')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextArea::make('address')
                    ->required()
                    ->maxLength(1024),

                Forms\Components\TextInput::make('total_amount')
                    ->required()
                    ->numeric()
                    ->prefix('IDR'),

                Forms\Components\TextInput::make('duration')
                    ->required()
                    ->numeric()
                    ->prefix('Days')
                    ->maxValue(255),

                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\Select::make('store_id')
                    ->relationship('store', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\DatePicker::make('started_at')
                    ->required(),

                Forms\Components\DatePicker::make('ended_at')
                    ->required(),

                Forms\Components\Select::make('delivery_type')
                    ->options([
                        'pickup' => 'Pickup Store',
                        'home_delivery' => 'Home Delivery',
                    ])
                    ->required(),

                Forms\Components\FileUpload::make('proof')
                    ->required()
                    ->openable(),

                Forms\Components\Select::make('is_paid')
                    ->options([
                        true => 'Paid',
                        false => 'Not Paid',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('index')->label('No.')->rowIndex(),

                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('total_amount')
                    ->numeric()
                    ->prefix('Rp'),
                
                Tables\Columns\TextColumn::make('trx_id')
                    ->numeric(),

                Tables\Columns\IconColumn::make('is_paid')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->label('Sudah Bayar?'),

                Tables\Columns\TextColumn::make('product.name'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->button(),
                Tables\Actions\EditAction::make()->button(),
                Tables\Actions\DeleteAction::make()->button(),
                Tables\Actions\RestoreAction::make()->button(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->label('Export')
                    ->exporter(TransactionExporter::class)
                    ->columnMapping(false)
                    ->icon('heroicon-o-printer')
                    ->color('success')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
                ExportBulkAction::make()
                    ->label('Export')
                    ->exporter(TransactionExporter::class)
                    ->columnMapping(false)
                    ->icon('heroicon-o-printer')
                    ->color('success')
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
            // 'view' => Pages\ViewTransation::route('/{record}'),
        ];
    }
}
