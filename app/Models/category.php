<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class category extends Model
{
    use HasFactory;
    use SoftDeletes;

    //fillable property to allow update er jonno
    protected $guarded = [];

    //category to User table relationship--

    function category_to_user(){
        return $this->belongsTo(User::class, 'added_by');
    }
}
