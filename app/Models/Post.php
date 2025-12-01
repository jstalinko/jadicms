<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
