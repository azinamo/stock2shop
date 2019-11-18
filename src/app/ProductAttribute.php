<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $fillable = ['product_id', 'key', 'value'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
