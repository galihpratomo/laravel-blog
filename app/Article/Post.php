<?php

namespace App\Article;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table        = 'posts';
    protected $primaryKey   = 'id';

    protected $fillable = [
        'title', 'content', 'category', 'status'
    ];
}