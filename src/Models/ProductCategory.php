<?php

namespace ManaCMS\ManaProductCategories\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'productcategories';
    public $timestamps = false;
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function childs()
    {
        return $this->hasMany(ProductCategory::class,'parent_id');
    }
    public function moreChilds()
    {
        return $this->hasMany(ProductCategory::class,'parent_id')->with('childs');
    }

    public function products()
    {
        return $this->morphedByMany(Product::class,'productcategorizable');
    }
    public function products2()
    {
        return $this->morphedByMany(Product::class,'productcategorizable')->where('lang',app()->getLocale())->take(8);
    }
    public function products_front()
    {
        return $this->morphedByMany(Product::class,'productcategorizable')->whereStatus(1);
    }

}
