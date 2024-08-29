<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\BrandResource;
use App\Filament\Resources\ProductResource;
use App\Filament\Resources\StoreResource;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Store;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $product = Product::all();
        $store = Store::all();
        $brand = Brand::all();

        return [
            Stat::make('Product', $product->count())
                ->url(ProductResource::getUrl())
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),
            Stat::make('Brand', $brand->count())
                ->url(BrandResource::getUrl())
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),
            Stat::make('Store', $store->count())
                ->url(StoreResource::getUrl())
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),
        ];
    }
}
