<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use HasFactory, SoftDeletes, Sortable;

    protected $fillable = [
        'image', 'title', 'price', 'category_id', 'description', 'rating', 'stock', 'likes', 'user_id'
    ];

    public $sortable = ['id', 'title', 'price', 'category_id', 'description', 'created_at', 'rating', 'stock', 'likes', 'updated_at'];

    protected $dates = ['deleted_at'];

    #   Binding relationship with product for everytime
    protected $with = ['category', 'vendor'];


    public function scopeAuth($query)
    {
        if (auth()->check() and auth()->user()->role->name == 'Vendor') {
            return $query->where('user_id', auth()->id());
        }
    }

    #   One to one inverse relationship between product & category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    #   One to one inverse relationship between product & category
    public function vendor()
    {
        return $this->belongsTo(User::class);
    }

    #   Getter magic method
    public function getCustomDescriptionAttribute()
    {
        return \Illuminate\Support\Str::words($this->description, 5);
    }

    #   Getter magic method
    public function getCustomPriceAttribute()
    {
        return '₹' . number_format((float)$this->price, 2, '.', '');  // Outputs -> 105.00;
    }

    #   Getter magic method
    public function getCustomCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->format('M d, Y');
    }

    #   Getter magic method
    public function getCustomImageAttribute()
    {
        if (file_exists($this->image))
            return $this->image;
        return url('images/logo.svg');
    }
    #   Getter magic method
    public function getCustomStockAttribute()
    {
        if ($this->stock)
            return 'In-Stock';
        return 'Out of Stock';
    }
}
