<?php

namespace App\Models\Article;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'name', 'content', 'clean_url','image','status'];
}
