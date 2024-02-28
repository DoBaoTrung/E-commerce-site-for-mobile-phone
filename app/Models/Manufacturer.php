<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manufacturer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'avatar', 'national', 'description'];
    public $timestamps = false;

    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
