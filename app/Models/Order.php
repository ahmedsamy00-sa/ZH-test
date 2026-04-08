<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use Notifiable;
    protected $fillable = [
        'user_id',
        'totalPrice'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function products(){
    return $this->belongsToMany(Product::class, 'order_items')->withPivot('quantity');
}
    public function delivery(){
        return $this->hasOne(Delivery::class);
    }
}
