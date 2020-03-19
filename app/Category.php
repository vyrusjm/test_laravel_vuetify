<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const CATEGORY_ACTIVE = 'active';
    const CATEGORY_INACTIVE = 'inactive';

    protected $fillable = [
        'name',
        'description',
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
        return $this->status == Category:: CATEGORY_ACTIVE;
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
