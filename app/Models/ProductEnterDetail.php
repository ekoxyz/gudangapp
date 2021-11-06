<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductEnterDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'product_enter_detail';
    protected $fillable = [
        'product_id',
        'product_enter-id',
        'quantity'
    ];

    /**
     * Relation
     */

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function enter()
    {
        return $this->belongsTo(ProductEnter::class, 'product_enter_id');
    }

}
