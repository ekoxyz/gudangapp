<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductExitDetail extends Model
{
    use HasFactory;
    protected $table = 'product_exit_details';

    protected $fillable = [
        'product_id',
        'product_exit_id',
        'quantity'
    ];

    /**
     * Relation
     */

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function exit()
    {
        return $this->belongsTo(ProductExit::class, 'product_exit_id');
    }

}
