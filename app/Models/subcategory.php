<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subcategory extends Model
{
    use HasFactory;

    //fillable property to allow update er jonno
    protected $guarded= [];

    // subcategory to user relation---
    function subcategory_to_user(){
        return $this->belongsTo(User::class,'added_by');
    }

    // subcategory to category relation

    function subcategory_to_category(){
        return $this->belongsTo(category::class, 'category_id');
    }
}
