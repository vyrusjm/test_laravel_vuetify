<?php

use App\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("brands")->insert([
            [
                'id' => '1',
                'name' => 'Oakley',
                'slug' => 'sunglasses-brand-oakley',
                'image' => 'oakley-logo.png',
                'status' => Brand::BRAND_ACTIVE,
            ],
            [
                'id' => '2',
                'name' => 'Hawkers',
                'slug' => 'sunglasses-brand-hawkers',
                'image' => 'hawkers-logo.png',
                'status' => Brand::BRAND_ACTIVE,
            ],
            [
                'id' => '3',
                'name' => 'Ray Ban',
                'slug' => 'sunglasses-brand-ray-ban',
                'image' => 'ray-ban-logo.png',
                'status' => Brand::BRAND_ACTIVE,
            ],
            [
                'id' => '4',
                'name' => 'Ray Ban JR',
                'slug' => 'sunglasses-brand-ray-ban-jr',
                'image' => 'ray-ban-logo.png',
                'status' => Brand::BRAND_ACTIVE,
            ],
            [
                'id' => '5',
                'name' => 'Catier',
                'slug' => 'sunglasses-brand-catier',
                'image' => 'catier-logo.png',
                'status' => Brand::BRAND_ACTIVE,
            ],
        ]);
    }
}
