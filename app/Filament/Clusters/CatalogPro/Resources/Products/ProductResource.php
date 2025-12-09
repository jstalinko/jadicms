<?php

namespace App\Filament\Clusters\CatalogPro\Resources\Products;

use App\Filament\Clusters\CatalogPro\CatalogProCluster;
use App\Filament\Clusters\CatalogPro\Resources\Products\Pages\CreateProduct;
use App\Filament\Clusters\CatalogPro\Resources\Products\Pages\EditProduct;
use App\Filament\Clusters\CatalogPro\Resources\Products\Pages\ListProducts;
use App\Filament\Clusters\CatalogPro\Resources\Products\Pages\ViewProduct;
use App\Filament\Clusters\CatalogPro\Resources\Products\Schemas\ProductForm;
use App\Filament\Clusters\CatalogPro\Resources\Products\Schemas\ProductInfolist;
use App\Filament\Clusters\CatalogPro\Resources\Products\Tables\ProductsTable;
use App\Models\Post;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ShoppingCart;

    protected static ?string $cluster = CatalogProCluster::class;

    protected static ?string $recordTitleAttribute = 'Product';

    protected static ?string $navigationLabel = 'Products';
    protected static ?int $navigationSort = 1;

    public static function getBreadcrumb(): string
    {
        return 'Products';
    }
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->where('type', 'product');
    }
    public static function form(Schema $schema): Schema
    {
        return ProductForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProductInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table);
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
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'view' => ViewProduct::route('/{record}'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }
}
