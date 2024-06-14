<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Like;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Like::create([
          'user_id' => 1,
          'post_id' => 4
        ]);

        Like::create([
          'user_id' => 2,
          'post_id' => 1
        ]);

        Like::create([
          'user_id' => 2,
          'post_id' => 2
        ]);

        Like::create([
          'user_id' => 1,
          'post_id' => 4
        ]);

        Like::create([
          'user_id' => 1,
          'post_id' => 4
        ]);


    }
}
