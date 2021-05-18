<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'product_id',
        'price',
        'discount',
        'shipping_address',
        'billing_address',
        'status',
    ];

    protected $dates = ['deleted_at'];

    #   One to one inverse relationship between product & category
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
