<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_code',
        'category_id',
        'product_price',
        'product_discount',
        'product_weight',
        'main_image',
        'additional_images',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_featured',
        'status',
    ];

    // If additional_images is a JSON or array type in the database
    protected $casts = [
        'additional_images' => 'array',
        'is_featured' => 'boolean',
    ];
}
