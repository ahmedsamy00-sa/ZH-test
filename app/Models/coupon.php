<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class coupon extends Model
{
    protected $fillable = [
        'product_id',
        'code',
        'discount',
        'expires_at'
    ];

    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
