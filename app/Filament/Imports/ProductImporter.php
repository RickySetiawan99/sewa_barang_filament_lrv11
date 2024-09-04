<?php

namespace App\Filament\Imports;

use App\Models\Product;
use Filament\Actions\Imports\Exceptions\RowImportFailedException;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class ProductImporter extends Importer
{
    protected static ?string $model = Product::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('thumbnail'),
            ImportColumn::make('about')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('price')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('category')
                ->requiredMapping()
                ->relationship(resolveUsing: 'name')
                ->rules(['required']),
            ImportColumn::make('brand')
                ->requiredMapping()
                ->relationship(resolveUsing: 'name')
                ->rules(['required']),
        ];
    }

    public function resolveRecord(): ?Product
    {
        if ($this->options['updateExisting'] ?? false) {
            return Product::firstOrNew([
                'name' => $this->data['name'],
            ]);
        }
    
        return new Product();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your product import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }

    public function getValidationMessages(): array
    {
        return [
            'name.required' => 'The name column must not be empty.',
        ];
    }
}
