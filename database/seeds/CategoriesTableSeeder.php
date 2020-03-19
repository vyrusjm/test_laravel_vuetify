<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("categories")->insert([
            [
                'id' => '1',
                'name' => 'Woman',
                'description' => 'For modern women, we have the best brands and designs that are on trend',
                'slug' => 'glasses-for-women',
                'image' => 'woman-category.jpg',
                'status' => Category::CATEGORY_ACTIVE,
            ],
            [
                'id' => '2',
                'name' => 'Man',
                'description' => 'For modern man, we have the best brands and designs that are on trend',
                'slug' => 'sunglasses-for-men',
                'image' => 'man-category.jpg',
                'status' => Category::CATEGORY_ACTIVE,
            ],
            [
                'id' => '3',
                'name' => 'Kids',
                'description' => 'For the children of the house we also have practical and fun designs',
                'slug' => 'sunglasses-for-kids',
                'image' => 'kids-category.jpg',
                'status' => Category::CATEGORY_ACTIVE,
            ]
        ]);
    }
}
