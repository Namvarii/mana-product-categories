<?php

namespace ManaCMS\ManaProductCategories\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategorizable extends Model
{
    protected $table = 'productcategorizables';
    public $timestamps = false;
    protected $fillable = ['category_id', 'categorizable_id', 'categorizable_type'];
}
