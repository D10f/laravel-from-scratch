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
            $query->where(function($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%');
            });
        });

        // $query->when($filters['category'] ?? false, function ($query, $category) {
        //     $query->whereExists(function ($query) use ($category) {
        //         $query
        //             ->from('categories')
        //             ->whereColumn('categories.id', 'posts.categoryId')
        //             ->where('categories.slug', $category);
        //     });
        // });

        // Same as above example. whereHas matches the model's accessor with
        // the same name provided
        $query->when($filters['category'] ?? false, function ($query, $category) {
            $query->whereHas('category', function($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        $query->when($filters['author'] ?? false, function ($query, $author) {
            $query->whereHas('author', function($query) use ($author) {
                $query->where('username', $author);
            });
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

    /**
     * Defines relationship between post and comments
     *
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
