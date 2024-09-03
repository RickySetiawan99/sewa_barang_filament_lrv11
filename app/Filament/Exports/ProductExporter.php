<?php

namespace App\Filament\Exports;

use App\Models\Product;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use OpenSpout\Common\Entity\Style\CellAlignment;
use OpenSpout\Common\Entity\Style\CellVerticalAlignment;
use OpenSpout\Common\Entity\Style\Color;
use OpenSpout\Common\Entity\Style\Style;

class ProductExporter extends Exporter
{
    protected static ?string $model = Product::class;

    public function getFileName(Export $export): string
    {
        return "products-{$export->getKey()}";
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
            ExportColumn::make('name'),
            ExportColumn::make('slug'),
            ExportColumn::make('about'),
            ExportColumn::make('category.name'),
            ExportColumn::make('brand.name'),
            ExportColumn::make('price'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your product export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

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
