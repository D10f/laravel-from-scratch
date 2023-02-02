<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

#    \Illuminate\Support\Facades\DB::listen(function ($query) {
#        logger($query->sql);
#    });

    return view('welcome', [
        #'posts' => Post::all()
        'posts' => Post::latest()->with('category', 'author')->get()
    ]);
});

Route::get('/post/{post}', function (Post $post) {
    return view('post-article', [
        'post' => $post
    ]);
});

Route::get('/categories/{category:slug}', function (Category $category) {
    return view('welcome', [
        'posts' => $category->posts->load(['category', 'author'])
        // 'posts' => $category->posts
    ]);
});

Route::get('/user/{user:username}', function (User $user) {
    return view('welcome', [
        'posts' => $user->posts->load(['category', 'author'])
        // 'posts' => $user->posts
    ]);
});
