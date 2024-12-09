<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'product_id',
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class, null, 'product_id')
            ->whereIn('id', $this->product_id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
