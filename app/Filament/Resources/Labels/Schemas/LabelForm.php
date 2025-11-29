<?php

namespace App\Filament\Resources\Labels\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class LabelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('taxonomy')
                    ->required()
                    ->default('category'),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('label_order')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('parent_id')
                    ->numeric(),
            ]);
    }
}
