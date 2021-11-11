<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductExit extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'product_exits';

    /**
     * Relation
     */
    public function detail()
    {
        return $this->hasMany(ProductExitDetail::class);
    }

    /**
     * get Attribute
     */
    public function getCreatedAttribute()
    {
        return $this->created_by;
    }
}
