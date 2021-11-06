<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    const PRODUCT_PUBLISHED = 'PRODUCT_PUBLISHED';
    const PRODUCT_ARCHIVED = 'PRODUCT_ARCHIVED';

/**
 * RELASI DATABASE
 */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function enterDetail()
    {
        return $this->hasMany(ProductEnterDetail::class);
    }
}
