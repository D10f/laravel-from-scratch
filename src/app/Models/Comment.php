<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * Creates a relationship between model and a post.
     *
     * @return Post;
     */
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    /**
     * Creates relationship between model and a user.
     *
     * @return User
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
