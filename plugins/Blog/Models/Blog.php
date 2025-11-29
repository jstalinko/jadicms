<?php

namespace Plugins\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['title'];

    protected $table = strtolower('Blog');
}