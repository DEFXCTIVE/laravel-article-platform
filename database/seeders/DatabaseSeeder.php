<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Article;
use Illuminate\Support\Facades\Hash;
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
        User::factory(1)->create(['name' => "admin",
        'email' =>"admin@admin.com",
        'email_verified_at' => now(),
        'is_admin'=>'1',
        'password' => Hash::make('admin'), // password
        'remember_token' => Str::random(10)]);

        User::factory(1)->create(['name' => "test",
        'email' =>"test@test.com",
        'email_verified_at' => now(),
        'is_admin'=>'0',
        'password' => Hash::make('test'), // password
        'remember_token' => Str::random(10)]);
        User::factory(50)->create();
        Category::factory(50)->create();
        $tags = Tag::factory(50)->create();
        $articles = Article::factory(50)->create();
        $articles->each(function($article) use($tags){
        $article->tags()->attach($tags->random(2));

        
    });
     
            //'article_id'=>$this->faker->randomElement(Article::pluck('id')),
            //'tag_id'=>$this->faker->randomElement(Tag::pluck('id'))
      
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
