<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
          'title' => 'Eerste geseede post',
          'message' => 'Ik ben een testmessage voor mijn seeder',
          'user_id' => 1
        ]);

        Post::create([
          'title' => 'Tweede geseede post',
          'message' => 'Ik ben een testmessage voor mijn seeder',
          'user_id' => 1
        ]);

        Post::create([
          'title' => 'Derde geseede post',
          'message' => 'Ik ben een testmessage voor mijn seeder',
          'user_id' => 1
        ]);

        Post::create([
          'title' => 'Eerste geseede post van Joske',
          'message' => 'Ik ben een testmessage voor mijn seeder',
          'user_id' => 2
        ]);

        Post::create([
          'title' => 'Vierde geseede post',
          'message' => 'Ik ben een testmessage voor mijn seeder',
          'user_id' => 1
        ]);
    }
}
