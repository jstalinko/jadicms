<?php

namespace App\Filament\Clusters\CatalogPro\Resources\Products\Pages;

use App\Filament\Clusters\CatalogPro\Resources\Products\ProductResource;
use App\Models\Label;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    public function getTitle(): string|Htmlable
    {
        return "Create Product";
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug'] = Str::slug($data['title']);
        $data['excerpt'] = Str::limit($data['content'], 100);
        $data['type'] = 'product';
        $data['user_id'] = Auth::user()->id;
        return $data;
    }

    protected function afterCreate(): void
    {
        $data = $this->data;
        $featured_images = $data['featured_images'];
        $record = $this->getRecord();
        $record->meta()->create([
            'meta_key' => 'featured_images',
            'meta_value' => json_encode(array_values($featured_images))
        ]);
        $record->meta()->create([
            'meta_key' => 'price',
            'meta_value' => $data['price']
        ]);

        $tagIds = [];

        if (!empty($data['tags']) && is_array($data['tags'])) {
            foreach ($data['tags'] as $tagName) {
                $tag = Label::firstOrCreate(
                    [
                        'name' => trim($tagName),
                        'taxonomy' => 'tag'
                    ],
                    [
                        'slug' => Str::slug($tagName),
                    ]
                );

                $tagIds[] = $tag->id;
            }
        }

        $categoryIds = [];

        if (!empty($formData['category'])) {
            $categoryIds[] = $formData['category'];
        }
        $categoryIds = [];

        if (!empty($formData['category'])) {
            $categoryIds[] = $formData['category'];
        }


        $allLabelIds = array_merge($categoryIds, $tagIds);

        $record->labels()->sync($allLabelIds);
    }
}
