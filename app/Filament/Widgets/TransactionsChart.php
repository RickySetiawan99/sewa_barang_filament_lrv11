<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class TransactionsChart extends ChartWidget
{
    use InteractsWithPageFilters;
    
    protected static ?string $heading = 'Transactions';

    protected static ?int $sort = 2;

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array {
        
        $startDate  = $this->filters['startDate'] ?? null;
        $endDate    = $this->filters['endDate'] ?? null;

        $transactions = Transaction::select('started_at')
                        ->when($startDate, fn ($query) => $query->whereDate('started_at', '>=', $startDate))
                        ->when($endDate, fn ($query) => $query->whereDate('started_at', '<=', $endDate))
                        ->get()
                        ->groupBy(function($transactions) {
                            return Carbon::parse($transactions->started_at)->format('d F y');
                        });
        $quantities = [];
        foreach ($transactions as $transaction => $value) {
            array_push($quantities, $value->count());
        }
        return [
            'datasets' => [
                [
                    'label' => 'Transaction Created',
                    'data' => $quantities,
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    'borderColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    'borderWidth' => 1
                ],
            ],
            'labels' => $transactions->keys(),
        ];
    }
}
