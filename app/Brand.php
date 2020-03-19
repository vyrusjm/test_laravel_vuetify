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

    //transforming the string into lowercase
    public function setNameAtrribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }
    // capitalizing the first letter of each word
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function isActive()
    {
        return $this->status == Brand::BRAND_ACTIVE;
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
