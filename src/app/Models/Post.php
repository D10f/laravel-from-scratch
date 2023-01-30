<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * Performs additional queries to retrieve the category and author automatically.
     */
    protected $with = ['category', 'author'];

    /**
     * Alternative syntax to /post/{post:slug} to retrive posts using route
     * params as the key in the database
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Defines the relationship a post has with a category. Possible relationships:
     * hasOne, hasMany, belongsTo, belongsToMany
     *
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId', 'id');
    }

    /**
     * Defines relationship between user and post.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }
}
