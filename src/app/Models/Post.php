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
     * scope[nameOfScope] is how we can build our own queries
     */
    public function scopeFilter($query, $filters)
    {
        // when is an Eloquent construct that runs a callback function given
        // a boolean condition
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query
                ->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%');
        });
    }

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
