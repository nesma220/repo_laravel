<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Post;
use \App\Models\Book;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
 User::factory(10)->create();
  // Post::factory()->count(10)->create();
Book::factory()->count(10)->create();


    }
}
