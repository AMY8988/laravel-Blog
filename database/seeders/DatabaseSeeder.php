<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Amy Moe',
             'email' => 'aa@gmail.com',
             'password' => Hash::make('asdfjkl;')
         ]);

        $categories = ["IT News" , "Sport" , "Food & Drink" , "Travel" , "Music"];
        foreach ($categories as $category){
            Category::factory()->create([
               "title" => $category,
               "slug" => Str::slug($category),
               "user_id" => User::inRandomOrder()->first()
            ]);
        }

        Post::factory(200)->create();
    }
}
