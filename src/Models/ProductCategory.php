<?php

namespace ManaCMS\ManaProductCategories\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function products()
    {
        return $this->morphedByMany(Product::class,'productcategorizable');
    }
    public function products2()
    {
        return $this->morphedByMany(Product::class,'productcategorizable')->where('lang',app()->getLocale())->take(8);
    }

}
