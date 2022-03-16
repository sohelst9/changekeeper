<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    // fillable property to allow for all field update
    protected $guarded = [];

    // product table to category table relationship
    function product_to_category(){
        return $this->belongsTo(category::class, 'category_id');
    }

    // product table to subcategory relationship--
    function product_to_subcategory(){
        return $this->belongsTo(subcategory::class, 'subcategory_id');
    }

    // product table to productThaumbnails relationship--
    function product_to_productThaumbnails(){
        return $this->hasMany(ProductThumbnails::class, 'product_id');
    }
}
