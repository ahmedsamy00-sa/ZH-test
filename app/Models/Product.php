<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'desc',
        'stoke',
        'price',
        'category_id',
        'trader_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function trader(){
        return $this->belongsTo(Trader::class);
    }
    public function orders(){
        return $this->belongsToMany(Order::class, 'order_items')->withPivot('quantity');
    }
    public function offer(){
        return $this->hasOne(Offer::class);
    }

    public function getFinalPriceAttribute()
    {
        $discount = $this->offers?->discount ?? 0;
        return $this->price - ($this->price * $discount / 100);
    }

    public function coupon(){
        return $this->hasMany(Coupon::class);
    }

}
