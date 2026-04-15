<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class banner extends Model
{
    protected $fillable = [
        'title',
        'offer_id'
    ];

    public function offer(){
        return $this->belongsTo(Offer::class);
    }
}
