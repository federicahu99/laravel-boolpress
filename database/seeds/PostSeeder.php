<?php

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {   
        $user_ids= User::all()->toArray();
        $categories_ids = Category::pluck('id')->toArray();
        $tags_ids = Tag::pluck('id')->toArray();
        for ($i =  0 ; $i < 10; $i++) {
            
            $new_post = new Post();
            $new_post->title = $faker->text(20);
            $new_post->user_id= 1;
            $new_post->category_id = Arr::random($categories_ids);
            $new_post->slug = Str::slug($new_post->title, '-');
            $new_post->content = $faker->paragraphs(2, true);
            $new_post->image = $faker->imageUrl(200, 200);

            $new_post->save();

            // randomizzatore tags

            $post_tags = [];

            $array_length = rand(0, count($tags_ids));

            while (count($post_tags) < $array_length) {
                $rand= Arr::random($tags_ids);
                if(!in_array($rand, $post_tags)) $post_tags[] = $rand;
            }

            $new_post->tags()->attach($post_tags);
        }
    }
}
