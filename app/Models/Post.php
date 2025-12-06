<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{

    protected $fillable = [
        'slug',
        'type',
        'title',
        'content',
        'excerpt',
        'status',
        'user_id',
        'featured_media_id',
        'image'
    ];

    // Author
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Readable attribute: $post->author_name
    public function getAuthorNameAttribute()
    {
        return $this->author->name ?? null;
    }

    // Categories & Tags
    public function labels()
    {
        return $this->belongsToMany(Label::class, 'post_label', 'post_id', 'label_id');
    }

    // Meta
    public function meta()
    {
        return $this->hasMany(Postmeta::class, 'post_id');
    }

    public function getMetaValue($key)
    {
        return optional($this->meta->where('meta_key', $key)->first())->meta_value;
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function getCommentsCountAttribute()
    {
        return $this->comments()->count();
    }
    public static function getArchiveByMonth()
    {
        // pastikan locale bahasa Indonesia
        Carbon::setLocale('id');

        $items = self::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym, COUNT(*) as count")
            ->where('type', 'post')
            ->groupBy('ym')
            ->orderBy('ym', 'desc')
            ->get();

        return $items->map(function ($item) {
            $carbon = Carbon::createFromFormat('Y-m', $item->ym);

            return [
                'month' => $item->ym,
                'count' => $item->count,
                'monthHuman' => $carbon->translatedFormat('F Y'),
                // Contoh: "Februari 2025"
            ];
        });
    }
}
