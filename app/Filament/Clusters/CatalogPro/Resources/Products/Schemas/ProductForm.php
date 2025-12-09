<?php

namespace App\Filament\Clusters\CatalogPro\Resources\Products\Schemas;

use App\Models\Label;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')
                    ->label('Primary Image')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('posts')
                    ->visibility('public')
                    ->columnSpanFull(),
                FileUpload::make('featured_images')
                    ->label('Featured Images')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('posts')
                    ->visibility('public')
                    ->multiple()
                    ->columnSpanFull(),
                TextInput::make('title')
                    ->required()
                    ->label('Product Name')
                    ->columnSpanFull(),
                RichEditor::make('content')
                    ->label('Description')
                    ->columnSpanFull()
                    ->required(),
                Select::make('status')
                    ->required()
                    ->options([
                        'publish' => 'Publish',
                        'draft' => 'Draft',
                    ])
                    ->default('publish'),
                Select::make('category')
                    ->required()
                    ->options(Label::getCategoryOnly()->pluck('name', 'id'))
                    ->default('post'),
                TextInput::make('price')
                    ->required()
                    ->label('Price')
                    ->default(0)->helperText('isi 0 jika harga "hubungi kami"'),
                TagsInput::make('tags')
                    ->required()
                    ->default('post'),
            ]);
    }
}
