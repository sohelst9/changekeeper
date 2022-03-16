<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;


   // protected fillable

   protected $guarded = [];
    // cart to product relationship---

    public function cart_to_product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }
}
