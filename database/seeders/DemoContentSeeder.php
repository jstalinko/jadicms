<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Post;
use App\Models\Label;
use App\Models\Postmeta;
use App\Models\Labelmeta;
use App\Models\Media;
use App\Models\Comment;

class DemoContentSeeder extends Seeder
{
    public function run(): void
    {
        // ----------------------------------------------------
        // USER
        // ----------------------------------------------------
        $user = User::first() ??
            User::create([
                'name' => 'Demo Author',
                'email' => 'author@example.com',
                'password' => bcrypt('password'),
            ]);

        // ----------------------------------------------------
        // LABELS (CATEGORIES & TAGS)
        // ----------------------------------------------------
        $categories = [
            'Technology',
            'Lifestyle',
            'Business'
        ];

        $tags = [
            'Laravel', 'Vue', 'Filament', 'PHP'
        ];

        $categoryModels = [];
        foreach ($categories as $cat) {
            $categoryModels[] = Label::create([
                'taxonomy' => 'category',
                'name' => $cat,
                'slug' => Str::slug($cat)
            ]);
        }

        $tagModels = [];
        foreach ($tags as $tag) {
            $tagModels[] = Label::create([
                'taxonomy' => 'tag',
                'name' => $tag,
                'slug' => Str::slug($tag)
            ]);
        }

        // ----------------------------------------------------
        // LABEL META
        // ----------------------------------------------------
        foreach (array_merge($categoryModels, $tagModels) as $label) {
            Labelmeta::create([
                'label_id' => $label->id,
                'meta_key' => 'color',
                'meta_value' => '#'.dechex(rand(0, 0xFFFFFF))
            ]);
        }

        // ----------------------------------------------------
        // MEDIA
        // ----------------------------------------------------
        $media = Media::create([
            'mime' => 'image/jpg',
            'path' => '/uploads/demo.jpg',
            'filename' =>'demo.jpg',
            'size' => '120',
            'user_id' => $user->id,
        ]);

        // ----------------------------------------------------
        // POSTS
        // ----------------------------------------------------
        $posts = [];

        for ($i = 1; $i <= 5; $i++) {
            $post = Post::create([
                'type' => 'post',
                'title' => "Demo Post $i",
                'slug' => Str::slug("demo post $i"),
                'image' => $media->id,
                'content' => "This is demo post number $i content.",
                'excerpt' => "Excerpt of post $i",
                'user_id' => $user->id,
            ]);

            $posts[] = $post;

            // Attach category
            $post->labels()->attach($categoryModels[array_rand($categoryModels)]->id);

            // Attach some tags
            $randomTags = collect($tagModels)->random(rand(1, 3));
            foreach ($randomTags as $tag) {
                $post->labels()->attach($tag->id);
            }

            // Add post meta
            Postmeta::create([
                'post_id' => $post->id,
                'meta_key' => 'views',
                'meta_value' => rand(50, 200),
            ]);
        }

        // ----------------------------------------------------
        // COMMENTS
        // ----------------------------------------------------
        foreach ($posts as $post) {
            Comment::create([
                'post_id' => $post->id,
                'user_id' => $user->id,
                'content' => 'Great post!',
            ]);

            Comment::create([
                'post_id' => $post->id,
                'user_id' => $user->id,
                'content' => 'Thanks for sharing!',
            ]);
        }

        echo "Demo content seeded successfully.\n";
    }
}
