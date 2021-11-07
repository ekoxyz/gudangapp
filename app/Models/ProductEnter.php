<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductEnter extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_enter';

    /**
     * Relation
     */
    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id');
    }
    public function enterDetail()
    {
        return $this->hasMany(ProductEnterDetail::class);
    }

    /**
     * get Attribute
     */
    public function getCreatedAttribute()
    {
        return $this->created_by;
    }

}
