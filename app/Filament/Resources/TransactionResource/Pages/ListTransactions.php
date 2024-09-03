<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use App\Models\Transaction;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListTransactions extends ListRecords
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
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
