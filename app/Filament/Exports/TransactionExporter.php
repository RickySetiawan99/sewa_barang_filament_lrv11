<?php

namespace App\Filament\Exports;

use App\Models\Transaction;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use OpenSpout\Common\Entity\Style\CellAlignment;
use OpenSpout\Common\Entity\Style\CellVerticalAlignment;
use OpenSpout\Common\Entity\Style\Color;
use OpenSpout\Common\Entity\Style\Style;

class TransactionExporter extends Exporter
{
    protected static ?string $model = Transaction::class;

    public function getFileName(Export $export): string
    {
        return "transactions-{$export->getKey()}";
    }

    public function getFormats(): array
    {
        return [
            ExportFormat::Xlsx,
        ];
    }
    
    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id'), 
            ExportColumn::make('trx_id'),
            ExportColumn::make('name'),
            ExportColumn::make('address'),
            ExportColumn::make('phone_number'),
            ExportColumn::make('product.name'),
            ExportColumn::make('store.name'),
            ExportColumn::make('duration'),
            ExportColumn::make('is_paid'),
            ExportColumn::make('delivery_type'),
            ExportColumn::make('started_at'),
            ExportColumn::make('ended_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your transaction export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }

    public function getXlsxHeaderCellStyle(): ?Style
    {
        return (new Style())
            ->setFontBold()
            ->setFontItalic()
            ->setFontSize(14)
            ->setFontName('Consolas')
            ->setFontColor(Color::rgb(255, 255, 77))
            ->setBackgroundColor(Color::rgb(0, 0, 0))
            ->setCellAlignment(CellAlignment::CENTER)
            ->setCellVerticalAlignment(CellVerticalAlignment::CENTER);
    }
}
