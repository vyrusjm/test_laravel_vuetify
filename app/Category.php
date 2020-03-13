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
    public function isActive()
    {
        return $this->status == Category:: CATEGORY_ACTIVE;
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
