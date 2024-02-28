<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

    protected $fillable = ['name', 'avatar', 'price', 'description', 'manufacturer_id'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_items')->withPivot(['product_id', 'avatar', 'description', 'quantity', 'total_price']);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_details');
    }
}
