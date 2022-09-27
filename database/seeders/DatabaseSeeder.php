<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
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


        $seda = User::create([
            'name'=>'Seda Karadeniz',
            'username'=>'seda-karadeniz',
            'email'=>'Seda.Karadeniz@student.hepl.be',
            'password'=>'Seda',
        ]);
        $maide = User::create([
            'name'=>'Maide Akdede',
            'username'=>'maide-akdede',
            'email'=>'maide.akdede@student.hepl.be',
            'password'=>'Maide',
        ]);
        $family = Category::create([
            'name'=>'family',
            'slug'=>'family',
        ]);
        $work =Category::create([
            'name'=>'work',
            'slug'=>'work',
        ]);
        $hobby =Category::create([
            'name'=>'hobby',
            'slug'=>'hobby',
        ]);

        Post::factory(300)->create();

        Comment::factory(1000)->create();

        /*  Post::create([
              'title'=>'mon premier post',
              'body'=>'un super post pour ma soeur',
              'published_at'=>now()->subDays(2),
              'slug'=>'post-1',
              'excerpt'=>'-',
              'category_id'=>$family->id,
              'user_id'=>$seda->id,
          ]);
          Post::create([
              'title'=>'mon deuxieme post',
              'body'=>'un super post pour mon frere',
              'published_at'=>now()->subDays(12),
              'slug'=>'post-2',
              'excerpt'=>'-',
              'category_id'=>$family->id,
              'user_id'=>$seda->id,
          ]);
          Post::create([
              'title'=>'mon troisieme post',
              'body'=>'un super post sur laravel',
              'published_at'=>now()->subDays(20),
              'slug'=>'post-3',
              'excerpt'=>'-',
              'category_id'=>$work->id,
              'user_id'=>$maide->id,
          ]);
          Post::create([
              'title'=>'mon quatrieme post',
              'body'=>'un super post sur moi',
              'published_at'=>now()->subDays(30),
              'slug'=>'post-4',
              'excerpt'=>'-',
              'category_id'=>$hobby->id,
              'user_id'=>$maide->id,
          ]);*/


    }
}
