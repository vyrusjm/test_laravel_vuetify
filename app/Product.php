<?php

namespace App;

use App\Category;
use App\Brand;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const PRODUCT_AVAILABLE = 'available';
    const PRODUCT_NOT_AVAILABLE = 'not available';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
        'status',
        'category_id',
        'brand_id'
    ];

    public function isAvailable()
    {
        return $this->status == Product::PRODUCT_AVAILABLE;
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
