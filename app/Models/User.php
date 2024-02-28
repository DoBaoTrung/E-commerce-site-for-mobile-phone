<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // use Authorizable;
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['first_name', 'last_name', 'email', 'gender', 'birthdate', 'phone', 'address', 'password'];

    protected $appends = ['full_name', 'gender_name', 'age'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->password = bcrypt($user->password);
        });
    }

    protected function getFullNameAttribute(): string
    {
        return $this->last_name . ' ' . $this->first_name;
    }

    protected function getGenderNameAttribute(): string
    {
        return ($this->gender === 1) ? 'Male' : 'Female';
    }

    protected function getAgeAttribute(): int
    {
        $now = new \DateTime();
        return $now->diff(new \DateTime($this->birthdate))->y;
    }

    public function carts(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
