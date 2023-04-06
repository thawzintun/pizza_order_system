<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable =[
        'rating_id',
        'rating_count',
        'message',
        'user_id',
        'product_id',   
    ];
}
