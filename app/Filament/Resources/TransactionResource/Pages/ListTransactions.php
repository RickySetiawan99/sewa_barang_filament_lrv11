<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Exports\TransactionExporter;
use App\Filament\Resources\TransactionResource;
use App\Models\Transaction;
use Filament\Actions;
use Filament\Actions\ActionGroup;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\ActionSize;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Actions\ExportAction;
use Illuminate\Database\Eloquent\Builder;

class ListTransactions extends ListRecords
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ActionGroup::make([
                ExportAction::make()
                    ->label('Export')
                    ->exporter(TransactionExporter::class)
                    ->columnMapping(false)
                    ->icon('heroicon-o-printer')
                    ->color('success')
            ])
            ->label('More actions')
            ->icon('heroicon-m-ellipsis-vertical')
            ->color('gray')
            ->button()
            ->dropdownPlacement('bottom-end'),
            Actions\CreateAction::make()
                ->label('Create')
                ->icon('heroicon-o-plus-circle')
                ->color('primary'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua'),
            'paid' => Tab::make('Sudah Bayar')
                ->icon('heroicon-m-check-circle')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_paid', true))
                ->badge(Transaction::query()->where('is_paid', true)->count())
                ->badgeColor('success'),
            'unpaid' => Tab::make('Belum Bayar')
                ->icon('heroicon-m-x-circle')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_paid', false))
                ->badge(Transaction::query()->where('is_paid', false)->count())
                ->badgeColor('danger'),
        ];
    }
}
