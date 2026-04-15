<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'product_id',
        'limit',
        'name',
        'desc',
        'discount'
    ];

    public function banner(){
        return $this->hasOne(banner::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
