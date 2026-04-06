<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'item',
        'quantity',
        'User_Id'
    ];

public function user()
{
    return $this->belongsTo(User::class);
}
}
