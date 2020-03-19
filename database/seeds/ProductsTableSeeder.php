<?php

use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("products")->insert([
            [
                'id' => '1',
                'name' => 'Oakley Holbrook Mix',
                'slug' => 'oakley-holbrook-mix',
                'description' => 'Capturing the shape of Holbrooks lens, this new edition rebuilds the best-seller with enhancements including stainless steel temples, Unobtainium® secure grip, and an O Matter ™ center. Holbrook is a timeless, classic design fused with modern Oakley technology. The iconic American frame design is accented by metal rivets and Oakley icons, perfect for those seeking equal parts performance and style.',
                'price' => '200.50',
                'stock' => '5',
                'image' => 'man-01-a.jpg',
                'status' => Product::PRODUCT_AVAILABLE,
                'category_id' => '2',
                'brand_id' => '1'
            ],
            [
                'id' => '2',
                'name' => 'Hawkers Sky Warwick Carbon Black',
                'slug' => 'hawkers-sky-warwick-carbon-black',
                'description' => 'This model combines a frame in a matte black finish with blue mirror lenses for a more daring look, perfect for every day no matter where you are.
                TR18 Micas with the Eastman US seal, one of the world leaders in copolyester technology. Eco-friendly and provides a unique balance of clarity and strength
                Category 3 and UV400 protection micas offer superior anti-glare protection
                Sunglasses made of TR90 with the EMS seal, considered the best frame Nylon in the world that provides more flexibility and resistance This model combines a frame in a black matte finish with blue mirror lenses for a more daring look, perfect for all days no matter where you are.
                TR18 Micas with the Eastman US seal, one of the world leaders in copolyester technology. Eco-friendly and provides a unique balance of clarity and strength
                Category 3 and UV400 protection micas offer superior anti-glare protection
                Sunglasses made of TR90 with the EMS seal, considered the best Nylon for frames in the world that provides more flexibility and resistance',
                'price' => '49.99',
                'stock' => '2',
                'image' => 'man-02-a.jpg',
                'status' => Product::PRODUCT_AVAILABLE,
                'category_id' => '2',
                'brand_id' => '2'
            ],
            [
                'id' => '3',
                'name' => 'Ray-Ban Ja-Jo RED',
                'slug' => 'ray-ban-ja-jo-red',
                'description' => 'Use the energy of sparkling eyes and the fun vibe of the festival world with a must-have new summer look: Ray-Ban JA-JO sunglasses. Adding additional impact to a completely timeless round metal shape, with a touch of contemporary color.',
                'price' => '149.30',
                'stock' => '1',
                'image' => 'woman-01-a.jpg',
                'status' => Product::PRODUCT_AVAILABLE,
                'category_id' => '1',
                'brand_id' => '3'
            ],
            [
                'id' => '4',
                'name' => 'Cartier Santos Dumont 77S2',
                'slug' => 'cartier-santos-dumont-77s2',
                'description' => 'Santos de Cartier metal sunglasses with a brushed platinum finish and bronze colored screws, pilot shape, sepia lambskin bridge, gray lenses covered with a white gold mirror, temples signed by Cartier.',
                'price' => '1025.00',
                'stock' => '3',
                'image' => 'woman-02-a.jpg',
                'status' => Product::PRODUCT_AVAILABLE,
                'category_id' => '1',
                'brand_id' => '5'
            ],
            [
                'id' => '5',
                'name' => 'Ray-Ban® Junior RB9538S',
                'slug' => 'ray-ban-junior-rb9538s',
                'description' => 'Copper colored mirrored lenses.',
                'price' => '94.25',
                'stock' => '10',
                'image' => 'kids-01-a.jpg',
                'status' => Product::PRODUCT_AVAILABLE,
                'category_id' => '3',
                'brand_id' => '4'
            ],
            [
                'id' => '6',
                'name' => 'Ray-Ban® Junior RB9063S',
                'slug' => 'ray-ban-junior-rb9063s',
                'description' => 'Blue mirrored lens in size 43, square shape.',
                'price' => '75.85',
                'stock' => '10',
                'image' => 'kids-02-a.jpg',
                'status' => Product::PRODUCT_AVAILABLE,
                'category_id' => '3',
                'brand_id' => '4'
            ],
        ]);
    }
}
