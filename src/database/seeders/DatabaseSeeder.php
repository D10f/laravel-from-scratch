<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $users = User::factory(3)->create();
        $categories = Category::factory(6)->create();

        /**
         * Loop $totalPosts times and extract a random user and category ids
         * on each iteration. Later, pass these values to the createMany method
         * to create $totalPost posts using these values, in addition to the ones
         * defined in the PostFactory run method.
         */
//        $totalPosts = 15;
//        $post_meta = array_map(function() use ($users, $categories) {
//            return [
//                'userId' => $users->random()->id,
//                'categoryId' => $categories->random()->id,
//            ];
//        }, array_fill(0, $totalPosts, []));

        //Post::factory()->createMany($post_meta);

        /**
         * Another method that does the same but shorter
         */
        Post::factory(15)->create(function() use ($users, $categories) {
            return [
                'userId' => $users->random()->id,
                'categoryId' => $categories->random()->id,
            ];
        });
    }
}
