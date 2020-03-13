<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    const BRAND_ACTIVE = 'active';
    const BRAND_INACTIVE = 'inactive';
    protected $fillable = [
        'name',
        'slug',
        'image',
        'status'
    ];

    public function isActive()
    {
        return $this->status == Brand::BRAND_ACTIVE;
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
