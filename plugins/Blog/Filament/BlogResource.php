<?php

namespace Plugins\Blog\Filament;

use Filament\Resources\Resource;
use Filament\Resources\Pages\ListRecords;
use BackedEnum;
use Filament\Support\Icons\Heroicon;
class BlogResource extends Resource
{
    protected static ?string $model = \Plugins\Blog\Models\Blog::class;
     protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $recordTitleAttribute = 'Blog';

    public static function getPages(): array
    {
        return [
            'index' => ListRecords::route('/'),
        ];
    }
}