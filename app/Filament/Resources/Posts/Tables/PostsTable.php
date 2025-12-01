<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('authorName')
                    ->searchable(),
                TextColumn::make('labels')
                    ->formatStateUsing(function ($state) {
                        if($state['taxonomy'] == 'category') {
                            return $state['name'];
                        }
                        return $state['name'];
                    })->label('Categories')
                    ->sortable(),
                    TextColumn::make('type')
                    ->searchable(),
                BadgeColumn::make('status')
                    ->label('Status')
                    ->searchable()->colors([
                        'success' => 'publish',
                        'danger' => 'draft',
                        'warning' => 'pending',
                    ]),
                TextColumn::make('commentsCount')
                    ->label('Comments')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
