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

// Route::get('/', function () {

// #    \Illuminate\Support\Facades\DB::listen(function ($query) {
// #        logger($query->sql);
// #    });

//     return view('welcome', [
//         #'posts' => Post::all()
//         'posts' => Post::latest()->with('category', 'author')->get(),
//         'categories' => Category::all()
//     ]);
// })->name('home');

Route::get('/', function() {

    $posts = Post::latest();

    if (request('search')) {
        $posts
            ->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('body', 'like', '%' . request('search') . '%');
    }

    return view('welcome', [
        'posts' => $posts->get(),
        'categories' => Category::all()
    ]);
})->name('home');

Route::get('/post/{post}', function (Post $post) {
    return view('post-single', [
        'post' => $post
    ]);
});

Route::get('/categories/{category:slug}', function (Category $category) {
    return view('welcome', [
        // 'posts' => $category->posts
        'posts' => $category->posts->load(['category', 'author']),
        'categories' => Category::all(),
        'currentCategory' => $category
    ]);
})->name('category');

Route::get('/user/{user:username}', function (User $user) {
    return view('welcome', [
        // 'posts' => $user->posts
        'posts' => $user->posts->load(['category', 'author']),
        'categories' => Category::all()
    ]);
});
